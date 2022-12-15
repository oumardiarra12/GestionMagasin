<?php

namespace App\Http\Requests\Categorie;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;

class StoreCategorieRequest extends FormRequest
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
            'NomCategorie' => 'required|unique:categories|min:3|max:50',
            "DesCategorie" => "nullable|min:2|max:255"
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
            'NomCategorie.required' => 'Le Nom de Categorie est Obligatoire.',
            'NomCategorie.unique' => 'Le Nom de Categorie est unique.',
            'NomCategorie.min' => 'Le Nom de Categorie doit etre au minimuim  3 caractere.',
            'NomCategorie.max' => 'Le Nom de Categorie doit etre au maxuim  3 caractere.',
            "DesCategorie.min" => "La Description de Categorie doit avoir au minimuim 3 Caracteres",
            "DesCategorie.max" => "La Description de Categorie doit avoir au maxuim 255 Caracteres",

        ];
    }
}
