<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            "nom" => "required|string|min:2|max:50",
            "prenom" => "nullable|string|min:2|max:50",
            "email" => ["required", "email", Rule::unique("users", "email")->ignore($this->user)],
            "image" => "required|image|mimes:png,jpg|max:2048",
            "password" => "required|string|min:3|max:20|confirmed"
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
            "nom.required" => "Le Nom Utilisateur est Obligatoire",
            "nom.string" => "Le Nom Utilisateur doit etre chaine caractere",
            "nom.min" => "Le Nom Utilisateur doit etre au miniuim 2 caractere",
            "nom.max" => "Le Nom Utilisateur doit etre au maxuim 50 caractere",
            "prenom.string" => "Le Prenom Utilisateur doit etre chaine caractere",
            "prenom.min" => "Le Prenom Utilisateur doit etre au miniuim 2 caractere",
            "prenom.max" => "Le Prenom Utilisateur doit etre au maxuim 50 caractere",
            "email.required" => "Email Utilisateur est Obligatoire",
            "email.unique" => "Email Utilisateur doit etre Unique",
            "email.email" => "Email Utilisateur doit etre Email valide",
            "image.required" => "Image Utilisateur est Obligatoire",
            "image.image" => "Image Utilisateur doit etre une Image",
            "image.mimes" => "Image Utilisateur doit etre png ou jpg",
            "image.max" => "Image Utilisateur doit etre au maxuim 2048kb",
            "password.required" => "Le Mot de Passe est Obligatoire",
            "password.string" => "Le Mot de Passe doit etre chaine caractere",
            "password.min" => "Le Mot de Passe doit etre au miniuim 3 caractere",
            "password.max" => "Le Mot de Passe doit etre au maxuim 20 caractere",
            "password.confirmed" => "Le Mot de Passe doit etre confirm",
        ];
    }
}
