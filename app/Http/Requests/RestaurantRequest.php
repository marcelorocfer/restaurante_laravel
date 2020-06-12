<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => 'required|min:5',
            'address'     => 'required|min:5',
            'description' => 'required|min:5'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            '*.min'                => 'O campo deve ter pelo menos 5 caracteres.',
            'name.required'        => 'O campo nome é obrigatório.',
            'address.required'     => 'O campo endereço é obrigatório.',
            'description.required' => 'O campo descrição é obrigatório.'
        ];
    }
}
