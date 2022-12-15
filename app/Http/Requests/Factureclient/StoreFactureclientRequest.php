<?php

namespace App\Http\Requests\Factureclient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;

class StoreFactureclientRequest extends FormRequest
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
            "NumFactureClient" => "required|unique:factureclients,NumFactureClient,id",
            "TotalFactureClient" => "required|numeric",
            "DescriptionFactureClient" => 'nullable|min:3',
            "StatusFactureClient" => "required",
            "livraison_id" => "required",
            "Referencefcl.*" => "required|max:50",
            "Designationfcl.*" => "required|max:50",
            "PrixVentefcl.*" => "required|numeric",
            "quantitefcl.*" => "required|numeric",
            "soustotalfcl.*" => "required|numeric",
            "factureclient_id.*" => "required",
            "article_id.*" => "required",
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
            'NumFactureClient.required' => 'Le Numero de  Facture Client est Obligatoire.',
            'NumFactureClient.unique' => 'Le Numero de Facture Client existe deja.',
            'TotalFactureClient.required' => 'Le Total de  Facture Client est Obligatoire.',
            'TotalFactureClient.numeric' => 'Le Total de  Facture Client doit etre numerique.',
            'DescriptionFactureClient.min' => 'La Description de Facture Client doit etre au minimuim  3 caractere.',
            'StatusFactureClient.required' => 'Le Status de Facture Client  est Obligatoire.',
            'livraison_id.required' => 'Le Numero Livraison de Facture Client  est Obligatoire.',
            'Referencefcl.required' => 'La Reference est Obligatoire.',
            'Referencefcl.*.required' => 'La Reference est Obligatoire.',
            'Designationfcl.required' => 'La Designation est Obligatoire.',
            'Designationfcl.*.required' => 'La Designation est Obligatoire.',
            'PrixVentefcl.required' => 'Le Prix Facture est Obligatoire.',
            'PrixVentefcl.*.required' => 'Le Prix Facture est Obligatoire.',
            'quantitefcl.required' => 'La quantite est Obligatoire.',
            'quantitefcl.*.required' => 'La quantite est Obligatoire.',
            'soustotalfcl.required' => 'Le Sous Total Facture est Obligatoire.',
            'soustotalfcl.*.required' => 'Le Sous Total Facture est Obligatoire.',
            'factureclient_id.required' => 'Le Numero Livraison est Obligatoire.',
            'factureclient_id.*.required' => 'Le Numero Livraison est Obligatoire.',
            'article_id.required' => 'Le Numero Article est Obligatoire.',
            'article_id.*.required' => 'Le Numero Article est Obligatoire.',

        ];
    }
}
