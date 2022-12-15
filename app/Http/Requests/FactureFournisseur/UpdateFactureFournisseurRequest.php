<?php

namespace App\Http\Requests\FactureFournisseur;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class UpdateFactureFournisseurRequest extends FormRequest
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
            "NumFactures" => ['required', Rule::unique('facturefournisseurs', 'NumFactures')->ignore($this->facturefournisseur)],
            "TotalFacture" => "required|numeric",
            "DescriptionFacture" => 'nullable|min:3',
            "StatusFacture" => "required",
            "reception_id" => "required",
            "ReferenceLigneFacture.*" => "required|max:50",
            "DesignationLigneFacture.*" => "required|max:50",
            "PrixAchatLigneFacture.*" => "required|numeric",
            "quantiteLigneFacture.*" => "required|numeric",
            "soustotalLigneFacture.*" => "required|numeric",
            "facturefournisseur_id.*" => "required",
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
            'NumFactures.required' => 'Le Numero de  Facture Achat est Obligatoire.',
            'NumFactures.unique' => 'Le Numero de Facture Achat existe deja.',
            'TotalFacture.required' => 'Le Total de  Facture Achat est Obligatoire.',
            'TotalFacture.numeric' => 'Le Total de  Facture Achat doit etre numerique.',
            'DescriptionFacture.min' => 'La Description de Facture Achat doit etre au minimuim  3 caractere.',
            'StatusFacture.required' => 'Le Status de Facture Achat  est Obligatoire.',
            'reception_id.required' => 'Le Numero Reception de Facture Achat  est Obligatoire.',
            'ReferenceLigneFacture.*.required' => 'La Reference est Obligatoire.',
            'DesignationLigneFacture.*.required' => 'La Designation est Obligatoire.',
            'PrixAchatLigneFacture.*.required' => 'Le Prix Facture est Obligatoire.',
            'quantiteLigneFacture.*.required' => 'La quantite est Obligatoire.',
            'soustotalLigneFacture.*.required' => 'Le Sous Total Facture est Obligatoire.',
            'facturefournisseur_id.*.required' => 'Le Numero Reception est Obligatoire.',
            'article_id.*.required' => 'Le Numero Article est Obligatoire.',
        ];
    }
}
