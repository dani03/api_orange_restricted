<?php

namespace App\Http\Requests\CLients;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;

class ClientStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'siren' => ['string'],
            'siret' => ['integer', 'required', 'unique:clients'],
            'nom_legal' =>['string']
        ];
    }
}
