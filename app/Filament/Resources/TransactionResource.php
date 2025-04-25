<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use App\Models\User;
use Filament\Tables;
use App\Models\Pricing;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Transaction;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TransactionResource\Pages;
use Filament\Notifications\Notification;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Payments';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Order')
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    Select::make('pricing_id')
                                        ->relationship('pricing', 'name')
                                        ->reactive()
                                        ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                            $pricing = Pricing::find($state);
                                            if ($pricing) {
                                                $duration = $pricing->duration;
                                                $set('duration', $duration);
                                                $tax = $pricing->price * 0.11;
                                                $set('total_tax_amount', $tax);
                                                $sub_total_amount = $pricing->price + $tax;
                                                $set('sub_total_amount', $sub_total_amount);
                                                $set('grand_total_amount', $sub_total_amount);
                                                $started_at = $get('started_at');
                                                if ($started_at) {
                                                    $set('ended_at', Carbon::parse($started_at)->addMonths($duration)->format('Y-m-d'));
                                                }
                                            } else {
                                                $set('duration', "");
                                                $set('total_tax_amount', "");
                                                $sub_total_amount = "";
                                                $set('sub_total_amount', $sub_total_amount);
                                                $set('grand_total_amount', $sub_total_amount);
                                                $set('started_at', "");
                                                $set('ended_at', "");
                                            }
                                        })
                                        ->afterStateHydrated(function ($state, Set $set) {
                                            $pricing = Pricing::find($state);
                                            if ($pricing) {
                                                $set('duration', $pricing->duration);
                                            }
                                        }),
                                    TextInput::make('duration')
                                        ->numeric()
                                        ->readOnly()
                                        ->prefix('Month')
                                ]),
                            Grid::make(3)->schema([
                                TextInput::make('total_tax_amount')
                                    ->required()
                                    ->prefix('IDR')
                                    ->readOnly(),
                                TextInput::make('sub_total_amount')
                                    ->required()
                                    ->prefix('IDR')
                                    ->readOnly(),
                                TextInput::make('grand_total_amount')
                                    ->required()
                                    ->prefix('IDR')
                                    ->readOnly()
                            ]),
                            Grid::make(2)
                                ->schema([
                                    DatePicker::make('started_at')
                                        ->reactive()
                                        ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                            if (!$state) return;

                                            $duration = $get('duration');
                                            if (!$duration) return;

                                            $set(
                                                'ended_at',
                                                Carbon::parse($state)
                                                    ->addMonths($duration)
                                                    ->format('Y-m-d')
                                            );
                                        })
                                        ->required(),
                                    DatePicker::make('ended_at')
                                        ->readOnly()
                                        ->required()
                                ])
                        ]),

                    Wizard\Step::make('Student information')
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    Select::make('user_id')
                                        ->label('Email')
                                        ->options(
                                            User::role('student')->pluck('email', 'id')
                                        )
                                        ->reactive()
                                        ->afterStateUpdated(function ($state, Get $get, Set $set) {
                                            $user = User::find($state);
                                            if ($user) {
                                                $set('name', $user->name);
                                            }
                                        })
                                        ->afterStateHydrated(function ($state, Set $set) {
                                            $user = User::find($state);
                                            if ($user) {
                                                $set('name', $user->name);
                                            }
                                        }),
                                    TextInput::make('name')
                                        ->readOnly()
                                ])
                        ]),

                    Wizard\Step::make('Payment information')
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    ToggleButtons::make('is_paid')
                                        ->label('Status')
                                        ->options([
                                            true => 'Paid',
                                            false => 'Unpaid'
                                        ])
                                        ->icons([
                                            true => 'heroicon-o-check-circle',
                                            false => 'heroicon-o-clock',
                                        ])
                                        ->required(),
                                    ToggleButtons::make('payment_type')
                                        ->options([
                                            'midtrans' => 'Midtrans',
                                            'manual' => 'Manual'
                                        ])
                                        ->icons([
                                            'midtrans' => 'heroicon-o-credit-card',
                                            'manual' => 'heroicon-o-banknotes',
                                        ])
                                        ->required(),
                                ]),
                            FileUpload::make('proof')
                                ->image()
                                ->directory('transactions')
                                ->maxSize(5000)
                                ->columnSpanFull()
                                ->required()
                        ]),
                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('booking_trx_id')
                    ->label('Booking code')
                    ->searchable(),
                TextColumn::make('user.email')->label('Email')
                    ->searchable(),
                TextColumn::make('pricing.name')
                    ->searchable(),
                IconColumn::make('is_paid')->label('Status')->boolean()
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('Approved')->action(function (Model $record) {
                    $record->is_paid = true;
                    $record->update();

                    Notification::make()
                        ->success()
                        ->title('Status')
                        ->body('Status has been updated')
                        ->send();
                    return redirect()->back();
                })
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
