<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "NomClient" => "required|max:100",
            "EmailClient" => "nullable|email",
            "TelephoneClient" => ["required", Rule::unique("clients", "TelephoneClient")->ignore($this->client)],
            "MobileClient" => ["required", Rule::unique("clients", "MobileClient")->ignore($this->client)],
            "AdresseClient" => "nullable|min:3",
            "RemarqueClient" => "nullable|max:255"
        ];
    }
    public function failedValidation(Validator $validator)

    {

        throw new HttpResponseException(response()->json([

            'success'   => false,

            'message'   => 'Validation errors',

            'data'      => $validator->errors()

        ]));
    }
    public function messages()

    {

        return [
            'NomClient.required' => 'Le Nom Client est Obligatoire.',
            'NomClient.max' => 'Le Nom Client doit etre au maxuim 100 caracteres.',
            'EmailClient.email' => 'Email de Client doit etre un Bon Email.',
            'TelephoneClient.required' => 'Le Telephone de Client est Obligatoire.',
            'TelephoneClient.unique' => 'Le Telephone de Client doit etre Unique.',
            'MobileClient.required' => 'Le Mobile de Client est Obligatoire.',
            'MobileClient.unique' => 'Le Mobile de Client doit etre Unique.',
            'AdresseClient.min' => 'Adresse de Client doit etre au miniuim 3 caracteres.',
            'RemarqueClient.max' => 'La Remarque de Client doit etre au maxuim 255 caracteres.',
        ];
    }
}
