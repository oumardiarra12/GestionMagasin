<?php

namespace App\Http\Requests\Unite;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;

class StoreUniteRequest extends FormRequest
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
            'NomUnite'=>'required|min:2|max:30|unique:unites',
            'CodeUnite'=>'required|max:10|unique:unites',
            'DescriptionUnite'=>'nullable',
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
            'NomUnite.required' => 'Le Nom de Unite est Obligatoire.',
            'NomUnite.unique' => 'Le Nom de Unite est unique.',
            'NomUnite.min' => 'Le Nom de Unite doit etre au minimuim  3 caractere.',
            'NomUnite.max' => 'Le Nom de Unite doit etre au maxuim  30 caractere.',
            'CodeUnite.required' => 'Le Code de Unite est Obligatoire.',
            'CodeUnite.unique' => 'Le Code de Unite est unique.',
            'CodeUnite.max' => 'Le Code de Unite doit etre au maxuim  10 caractere.',

        ];

    }
}
