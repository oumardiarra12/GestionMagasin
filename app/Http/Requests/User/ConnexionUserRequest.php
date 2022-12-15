<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;

class ConnexionUserRequest extends FormRequest
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
            "email" => "required|email",
            "password" => "required|string|min:3|max:20"
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
            "email.required" => "Email Utilisateur est Obligatoire",
            "email.email" => "Email Utilisateur doit etre Email valide",
            "password.required" => "Le Mot de Passe est Obligatoire",
            "password.string" => "Le Mot de Passe doit etre chaine caractere",
            "password.min" => "Le Mot de Passe doit etre au miniuim 3 caractere",
            "password.max" => "Le Mot de Passe doit etre au maxuim 20 caractere",
        ];
    }
}
