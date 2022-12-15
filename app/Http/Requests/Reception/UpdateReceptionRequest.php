<?php

namespace App\Http\Requests\Reception;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class UpdateReceptionRequest extends FormRequest
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
            "NumRecept" => "required",
            "TotalRecept" => "required|numeric",
            "DescriptionRecept" => "nullable|min:2",
            "StatusReception" => "required",
            "commandeachat_id" => "required",
            "ReferenceLigneRecept.*" => "required|max:50",
            "DesignationLigneRecept.*" => "required|max:50|string",
            "PrixVenteLigneRecept.*" => "required|numeric",
            "quantiteCMDLigneRecept.*" => "required|numeric",
            "quantiteLigneRecept.*" => "required|numeric",
            "soustotalLigneRecept.*" => "required|numeric",
            "reception_id.*" => "required",
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
            'NumRecept.required' => 'Le Numero de Reception est Obligatoire.',
            'TotalRecept.required' => 'Le Total de Reception est Obligatoire.',
            'TotalRecept.numeric' => 'Le Total de Reception  doit etre numerique.',
            'DescriptionRecept.min' => 'La Description de Reception doit etre au minimuim  2 caractere.',
            'StatusReception.required' => 'Le Status de Reception est Obligatoire.',
            'commandeachat_id.required' => 'Le Numero de Commande Achat est Obligatoire.',
            'ReferenceLigneRecept.*.required' => 'La Reference est Obligatoire.',
            'ReferenceLigneRecept.*.max' => 'La Reference doit etre maxuim 50 caracteres.',
            'DesignationLigneRecept.*.required' => 'La Designation est Obligatoire.',
            'DesignationLigneRecept.*.max' => 'La Designation doit etre maxuim 50 caracteres.',
            'DesignationLigneRecept.*.string' => 'La Designation doit etre une chaine de Caracteres.',
            'PrixVenteLigneRecept.*.required' => 'Le Prix Reception est Obligatoire.',
            'PrixVenteLigneRecept.*.numeric' => 'Le Prix Reception doit etre numerique.',
            'quantiteCMDLigneRecept.*.required' => 'La quantite Commande a Reception est Obligatoire.',
            'quantiteCMDLigneRecept.*.numeric' => 'La quantite Commande a Reception doit etre numerique.',
            'quantiteLigneRecept.*.required' => 'La quantite Reception est Obligatoire.',
            'quantiteLigneRecept.*.numeric' => 'La quantite Reception doit etre numerique.',
            'soustotalLigneRecept.*.required' => 'Le sous Total Reception est Obligatoire.',
            'soustotalLigneRecept.*.numeric' => 'Le sous Total Reception doit etre numerique.',
            'commandeachat_id.*.required' => 'Le Numero Commande Achat est Obligatoire.',
            'article_id.*.required' => 'Le Numero Article est Obligatoire.',
        ];
    }
}
