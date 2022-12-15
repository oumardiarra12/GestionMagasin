<?php

namespace App\Http\Requests\Commandeclient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class UpdateCommandeclientRequest extends FormRequest
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
            "NumCommandeClient" => ["required", Rule::unique("commandeclients", "NumCommandeClient")->ignore($this->commandeclient)],
            "TotalCommandeClient" => "required|numeric",
            "DescriptionCommandeClient" => "nullable|min:2|max:255",
            "StatusCommandeClient" => "required",
            "client_id" => "required",
            "Referencecmdc.*" => "required",
            "Designationcmdc.*" => "required",
            "PrixVentecmdc.*" => "required",
            "quantitecmdc.*" => "required",
            "soustotalcmdc.*" => "required",
            "commandeclient_id.*" => "required",
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
            'NumCommandeClient.required' => 'Le Numero de  Commande Client est Obligatoire.',
            'NumCommandeClient.unique' => 'Le Numero de Commande Client existe deja.',
            'TotalCommandeClient.required' => 'Le Total de  Commande Client est Obligatoire.',
            //'TotalCommandeAchat.digits' => 'Le Total de  Commande Achat doit etre decimal.',
            'DescriptionCommandeClient.min' => 'La Description de Commande Client doit etre au minimuim  2 caractere.',
            'client_id.required' => 'Le Client  est Obligatoire.',
            'Referencecmdc.*.required' => 'La Reference est Obligatoire.',
            'Designationcmdc.*.required' => 'La Designation est Obligatoire.',
            'PrixAchatcmdc.*.required' => 'Le Prix Client est Obligatoire.',
            'quantitecmdc.*.required' => 'La quantite est Obligatoire.',
            'soustotalcmdc.*.required' => 'Le Sous Total Client est Obligatoire.',
            'commandeclient_id.*.required' => 'Le Numero Commande Client est Obligatoire.',
            'article_id.*.required' => 'Le Numero Article est Obligatoire.',

        ];
    }
}
