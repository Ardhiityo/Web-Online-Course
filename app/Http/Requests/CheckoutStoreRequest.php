<?php

namespace App\Http\Requests;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutStoreRequest extends FormRequest
{

    public function prepareForValidation()
    {
        $this->merge([
            'pricing_id' => (int)$this->input('pricing_id')
        ]);

        Log::info('Request data:', $this->all());
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pricing_id' => 'required|integer|exists:pricings,id',
        ];
    }
}
