<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'      => 'O campo nome é obrigatório.',
            'email.required'     => 'O campo email é obrigatório.',
            'email.email'        => 'O campo de email deve conter um e-mail válido.',
            'email.unique'       => 'O email digitado já está sendo utilizado.',
            'password.min'       => 'A senha deve ter pelo menos 6 caracteres.',
            'password.required'  => 'O campo senha é obrigatório.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',
            '*.max'              => 'O campo não pode ter mais que 255 caracteres.'
        ];
    }
}
