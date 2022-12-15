<?php

namespace App\Http\Requests\lignecommandeachat;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;

class StoreLigneCommandeachatRequest extends FormRequest
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
            "Referencecmdf"=>"required|array",
            "Referencecmdf.*"=>"required",
            "Designationcmdf"=>"required|array",
            "Designationcmdf.*"=>"required|string",
            "PrixAchatcmdf"=>"required|array",
            "PrixAchatcmdf.*"=>"required",
            "quantitecmdf"=>"required|array",
            "quantitecmdf.*"=>"required",
            "soustotalcmdf"=>"required|array",
            "soustotalcmdf.*"=>"required",
            "commandeachat_id"=>"required|array",
            "commandeachat_id.*"=>"required",
            "article_id"=>"required|array",
            "article_id.*"=>"required"
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
            'Referencecmdf.required|array' => 'La Reference est Obligatoire.',
            'Referencecmdf.*.required' => 'La Reference est Obligatoire.',
            'Designationcmdf.required|array' => 'La Designation est Obligatoire.',
            'Designationcmdf.*.required' => 'La Designation est Obligatoire.',
            'PrixAchatcmdf.required|array' => 'Le Prix Achat est Obligatoire.',
            'PrixAchatcmdf.*.required' => 'Le Prix Achat est Obligatoire.',
            'quantitecmdf.required|array' => 'La quantite est Obligatoire.',
            'quantitecmdf.*.required' => 'La quantite est Obligatoire.',
            'soustotalcmdf.required|array' => 'Le Sous Total Achat est Obligatoire.',
            'soustotalcmdf.*.required' => 'Le Sous Total Achat est Obligatoire.',
            'commandeachat_id.required|array' => 'Le Numero Commande Achat est Obligatoire.',
            'commandeachat_id.*.required' => 'Le Numero Commande Achat est Obligatoire.',
            'article_id.required|array' => 'Le Numero Article est Obligatoire.',
            'article_id.*.required' => 'Le Numero Article est Obligatoire.',

        ];
    }
}
