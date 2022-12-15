<?php

namespace App\Http\Requests\Fournisseur;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;

class StoreFournisseurRequest extends FormRequest
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
            "NomFournisseur"=>"required|min:2|max:100",
            "TelephoneFournisseur"=>"required|min:8",
            "MobileFournisseur"=>"required|min:8",
            "AdresseFournisseur"=>"nullable",
            "EmailFournisseur"=>"required|email|unique:fournisseurs,EmailFournisseur,id",
            "RemarqueFournisseur"=>"nullable",
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
            'NomFournisseur.required' => 'Le Nom de Fournisseur est Obligatoire.',
            'NomFournisseur.min' => 'Le Nom de Fournisseur doit etre au minimuim  3 caractere.',
            'NomFournisseur.max' => 'Le Nom de Fournisseur doit etre au maxuim  100 caractere.',
            'TelephoneFournisseur.required' => 'Le Telephone de Fournisseur est Obligatoire.',
            'TelephoneFournisseur.min' => 'Le Telephone de Fournisseur doit etre au minimuim  8 caractere.',
            'MobileFournisseur.required' => 'Le Mobile de Fournisseur est Obligatoire.',
            'MobileFournisseur.min' => 'Le Mobile de Fournisseur doit etre au minimuim  8 caractere.',
            'EmailFournisseur.required' => 'Email de Fournisseur est Obligatoire.',
            'EmailFournisseur.email' => 'Saisir um Bon Email de Fournisseur.',
            'EmailFournisseur.unique' => 'Email de Fournisseur  existe deja.',

        ];

    }
}
