<?php

namespace App\Http\Requests\Commandeachat;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;

class StoreCommandeachatRequest extends FormRequest
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
            "NumCommandeAchat" => "required|unique:commandeachats,NumCommandeAchat",
            "TotalCommandeAchat" => "required",
            "DescriptionCommandeAchat" => "nullable|min:2",
            "StatusCommandeAchat" => "nullable",
            "fournisseur_id" => "required",
            "Referencecmdf.*" => "required",
            "Designationcmdf.*" => "required",
            "PrixAchatcmdf.*" => "required",
            "quantitecmdf.*" => "required",
            "soustotalcmdf.*" => "required",
            "commandeachat_id.*" => "required",
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
            'NumCommandeAchat.required' => 'Le Numero de  Commande Achat est Obligatoire.',
            'NumCommandeAchat.unique' => 'Le Numero de Commande Achat existe deja.',
            'TotalCommandeAchat.required' => 'Le Total de  Commande Achat est Obligatoire.',
            'DescriptionCommandeAchat.min' => 'La Description de Commande Achat doit etre au minimuim  2 caractere.',
            'fournisseur_id.required' => 'Le Fournisseur  est Obligatoire.',
            'Referencecmdf.*.required' => 'La Reference est Obligatoire.',
            'Designationcmdf.*.required' => 'La Designation est Obligatoire.',
            'PrixAchatcmdf.*.required' => 'Le Prix Achat est Obligatoire.',
            'quantitecmdf.*.required' => 'La quantite est Obligatoire.',
            'soustotalcmdf.*.required' => 'Le Sous Total Achat est Obligatoire.',
            'commandeachat_id.*.required' => 'Le Numero Commande Achat est Obligatoire.',
            'article_id.*.required' => 'Le Numero Article est Obligatoire.',

        ];
    }
}
