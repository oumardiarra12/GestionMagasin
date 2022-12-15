<?php

namespace App\Http\Requests\Livraison;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;

class StoreLivraisonRequest extends FormRequest
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
            "NumLivraison" => "required|unique:livraisons,NumLivraison,id",
            "TotalLivraison" => "required|numeric",
            "DescriptionLivraison" => "nullable|min:2",
            "StatusLivraison" => "required",
            "commandeclient_id" => "required",
            "ReferenceLigneLivraison.*" => "required|max:50",
            "DesignationLigneLivraison.*" => "required|max:50",
            "PrixVenteLigneLivraison.*" => "required|numeric",
            "quantiteLigneLivraison.*" => "required|numeric",
            "quantiteCMDCLLigneLivraison.*" => "required|numeric",
            "soustotalLigneLivraison.*" => "required|numeric",
            "livraison_id.*" => "required",
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
            'NumLivraison.required' => 'Le Numero de Livraison est Obligatoire.',
            'NumLivraison.unique' => 'Le Numero de Livraison doit etre Unique.',
            'TotalLivraison.required' => 'Le Total de Livraison est Obligatoire.',
            'TotalLivraison.numeric' => 'Le Total de Livraison  doit etre numerique.',
            'DescriptionLivraison.min' => 'La Description de Livraison doit etre au minimuim  2 caractere.',
            'StatusLivraison.required' => 'Le Status de Livraison est Obligatoire.',
            'commandeclient_id.required' => 'Le Numero de Commande Client est Obligatoire.',
            'ReferenceLigneLivraison.*.required' => 'La Reference est Obligatoire.',
            'DesignationLigneLivraison.*.required' => 'La Designation est Obligatoire.',
            'PrixVenteLigneLivraison.*.required' => 'Le Prix Client est Obligatoire.',
            'quantiteLigneLivraison.*.required' => 'La quantite est Obligatoire.',
            'quantiteCMDCLLigneLivraison.*.required' => 'La quantite Livrer est Obligatoire.',
            'soustotalLigneLivraison.*.required' => 'Le Sous Total Client est Obligatoire.',
            'livraison_id.*.required' => 'Le Numero Livraison Client est Obligatoire.',
            'article_id.*.required' => 'Le Numero Article est Obligatoire.',

        ];
    }
}
