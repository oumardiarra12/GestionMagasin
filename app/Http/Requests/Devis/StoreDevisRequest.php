<?php

namespace App\Http\Requests\Devis;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;

class StoreDevisRequest extends FormRequest
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
            "NumDevis" => "required|unique:devis,NumDevis,id",
            "TotalDevis" => "required|numeric",
            "RemisDevis" => "required|numeric",
            "DescriptionDevis" => "nullable|min:3|max:255",
            "StatusDevis" => "required|string",
            "client_id" => "required",
            "ReferenceDevis.*" => "required|max:50",
            "DesignationDevis.*" => "required|max:50",
            "PrixVenteDevis.*" => "required|numeric",
            "quantiteDevis.*" => "required|numeric",
            "soustotalDevis.*" => "required|numeric",
            "devis_id.*" => "required",
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
            'NumDevis.required' => 'Le Numero de  Devis est Obligatoire.',
            'NumDevis.unique' => 'Le Numero de Devis existe deja.',
            'TotalDevis.required' => 'Le Total de  Devis est Obligatoire.',
            'TotalDevis.numeric' => 'Le Total de  Devis doit etre numerique.',
            'RemisDevis.required' => 'Le Remis de  Devis est Obligatoire.',
            'RemisDevis.numeric' => 'Le Remis de  Devis doit etre numerique.',
            'DescriptionDevis.min' => 'La Description de Devis doit etre au minimuim  3 caractere.',
            'DescriptionDevis.max' => 'La Description de Devis doit etre au maxuim  255 caractere.',
            'StatusDevis.required' => 'Le Status de Devis  est Obligatoire.',
            'StatusDevis.string' => 'Le Status de Devis  doit etre Chaine de Caractere.',
            'ReferenceDevis.*.required' => 'La Reference est Obligatoire.',
            'ReferenceDevis.*.max' => 'La Reference doit etre maxuim 50 caracteres.',
            'DesignationDevis.*.required' => 'La Designation est Obligatoire.',
            'DesignationDevis.*.max' => 'La Designation doit etre 50 caracteres.',
            'PrixVenteDevis.*.required' => 'Le Prix Devis est Obligatoire.',
            'PrixVenteDevis.*.numeric' => 'Le Prix Devis doit etre Numerique.',
            'quantiteDevis.*.required' => 'La quantite est Obligatoire.',
            'quantiteDevis.*.numeric' => 'La quantite doit etre numerique.',
            'soustotalDevis.*.required' => 'Le Sous Total Devis est Obligatoire.',
            'soustotalDevis.*.numeric' => 'Le Sous Total Devis doit etre numerique.',
            'devis_id.*.required' => 'Le Numero Devis est Obligatoire.',
            'article_id.*.required' => 'Le Numero Article est Obligatoire.',

        ];
    }
}
