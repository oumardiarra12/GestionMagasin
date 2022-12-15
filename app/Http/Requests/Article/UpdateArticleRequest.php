<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class UpdateArticleRequest extends FormRequest
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
            'ReferenceArticle' => ['required', 'min:2', 'max:50', Rule::unique('articles')->ignore($this->article)],
            'CodeBarre' => ['nullable', 'numeric', 'min:13', Rule::unique('articles')->ignore($this->article)],
            'NomArticle' => 'required|min:2|max:50|string',
            'ImageArticle' => 'required|image|mimes:png,jpg,jepg|max:2048',
            'PrixAchat' => 'required|numeric',
            'PrixVente' => 'required|numeric',
            'StockActuel' => 'nullable|numeric',
            'StockMin' => 'nullable|numeric',
            'DescriptionArticle' => 'nullable',
            'categorie_id' => 'required',
            'unite_id' => 'required'
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

            'ReferenceArticle.required' => 'La Reference de Article est Obligatoire.',
            'ReferenceArticle.min' => 'La Reference de Article doit etre au minimuim  2 caractere.',
            'ReferenceArticle.max' => 'La Reference de Article doit etre au maxuim  50 caractere.',
            'ReferenceArticle.unique' => 'La Reference de Article est unique.',
            'CodeBarre.numeric' => 'Le Code Barre doit etre Numerique.',
            'CodeBarre.min' => 'Le Code Barre n est pas bon.',
            'CodeBarre.unique' => 'Le Code Barre de Article est unique.',
            'NomArticle.required' => 'Le Nom Article est Obligatoire.',
            'NomArticle.min' => 'Le Nom de Article doit etre au minimuim  2 caractere.',
            'NomArticle.max' => 'Le Nom de Article doit etre au maxuim  50 caractere.',
            'NomArticle.string' => 'Le Nom de Article doit etre une chaine de caractere.',
            'ImageArticle.required' => 'Image de Article est Obligatoire.',
            'ImageArticle.image' => 'Image de Article doit etre Image.',
            'ImageArticle.mimes' => 'Image de Article doit etre Image jpg ou png ou jpeg.',
            'ImageArticle.max' => 'Le Taille Image de Article doit etre au maxuim.',
            'PrixAchat.required' => 'Le Prix Achat de Article est Obligatoire.',
            'PrixAchat.numeric' => 'Le Prix Achat de Article doit etre Numerique.',
            'PrixVente.required' => 'Le Prix Vente de Article est Obligatoire.',
            'PrixVente.numeric' => 'Le Prix Vente de Article doit etre Numerique.',
            'StockActuel.numeric' => 'Le Stock Actuel de Article doit etre Numerique.',
            'StockMin.numeric' => 'Le Stock Min de Article doit etre Numerique.',
            'categorie_id.required' => 'La Famille de Article est Obligatoire.',
            'unite_id.required' => 'Unite de Article est Obligatoire.',
        ];
    }
}
