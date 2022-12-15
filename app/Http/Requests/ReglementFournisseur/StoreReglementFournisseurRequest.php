<?php

namespace App\Http\Requests\ReglementFournisseur;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;

class StoreReglementFournisseurRequest extends FormRequest
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
            "ReferenceRegF"=>"required|max:50|unique:reglementfournisseurs,ReferenceRegF,id",
            "MontantAPayerRegF"=>"required|numeric",
            "MontantPayerRgF"=>"required|numeric",
            "MontantRestant"=>"required|numeric",
            "facturefournisseur_id"=>"required",
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
            'ReferenceRegF.required' => 'Le Numero de Reglement Fournisseur est Obligatoire.',
            'ReferenceRegF.max' => 'Le Numero de Reglement Fournisseur doit etre au maxuim 50 caracteres.',
            'ReferenceRegF.unique' => 'Le Numero de Reglement Fournisseur doit etre unique.',
            'MontantAPayerRegF.required' => 'Le Montant a Payer de Reglement Fournisseur est Obligatoire.',
            'MontantAPayerRegF.numeric' => 'Le Montant a Payer de Reglement Fournisseur  doit etre numerique.',
            'MontantPayerRgF.required' => 'Le Montant  Payer de Reglement Fournisseur est Obligatoire.',
            'MontantPayerRgF.numeric' => 'Le Montant  Payer de Reglement Fournisseur  doit etre numerique.',
            'MontantRestant.required' => 'Le Montant  Restant de Reglement Fournisseur est Obligatoire.',
            'MontantRestant.numeric' => 'Le Montant  Restant de Reglement Fournisseur  doit etre numerique.',
            'facturefournisseur_id.required' => 'Le Numero de  Facture de Reglement Fournisseur est Obligatoire.',
        ];

    }
}
