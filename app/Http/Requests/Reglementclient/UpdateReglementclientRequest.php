<?php

namespace App\Http\Requests\Reglementclient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class UpdateReglementclientRequest extends FormRequest
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
            "ReferenceRegCl" => ["required", "max:50", Rule::unique("reglementclients", "ReferenceRegCl")->ignore($this->reglementclient)],
            "MontantAPayerRegCl" => "required|numeric",
            "MontantPayerRgCl" => "required|numeric",
            "MontantRestant" => "required|numeric",
            "factureclient_id" => "required"
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
            'ReferenceRegCl.required' => 'Le Numero de Reglement Client est Obligatoire.',
            'ReferenceRegCl.max' => 'Le Numero de Reglement Client doit etre au maxuim 50 caracteres.',
            'ReferenceRegCl.unique' => 'Le Numero de Reglement Client doit etre unique.',
            'MontantAPayerRegCl.required' => 'Le Montant a Payer de Reglement Client est Obligatoire.',
            'MontantAPayerRegCl.numeric' => 'Le Montant a Payer de Reglement Client  doit etre numerique.',
            'MontantPayerRgCl.required' => 'Le Montant  Payer de Reglement Client est Obligatoire.',
            'MontantPayerRgCl.numeric' => 'Le Montant  Payer de Reglement Client  doit etre numerique.',
            'MontantRestant.required' => 'Le Montant  Restant de Reglement Client est Obligatoire.',
            'MontantRestant.numeric' => 'Le Montant  Restant de Reglement Client  doit etre numerique.',
            'factureclient_id.required' => 'Le Numero de  Facture de Reglement Client est Obligatoire.',
        ];
    }
}
