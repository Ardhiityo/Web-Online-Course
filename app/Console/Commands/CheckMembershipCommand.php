<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\CheckMembershipJob;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;

class CheckMembershipCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-membership-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Bus::batch([
            new CheckMembershipJob()
        ])->then(function () {
            // $this->info('Membership check completed.');
            Log::info('Membership check completed.');
        })->catch(function ($e) {
            // $this->error('Membership check failed: ' . $e->getMessage());
            Log::info('Membership check failed: ' . $e->getMessage());
        })->finally(function () {
            // $this->info('Membership check job dispatched.');
            Log::info('Membership check job dispatched.');
        })->dispatch();
    }
}
