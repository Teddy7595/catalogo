<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserUpdateRequest extends FormRequest
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
        return 
        [
            //SE CREA LAS REGLAS DE VALIDACION DEL REQUEST
            'name' => 'string|required',
            'password' => 'string|required',
            'email' => 'string|required',
            'ci' => 'string|required'
        ];
    }

    public function messages()
    {
        return
        [
            'name.required' => 'El nombre es obligatorio',
            'password.required' => 'El password es obligatorio',
            'email.required' => 'El email es obligatorio',
            'ci.required' => 'El codigo de identificación es obligatorio'  
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        $json['response'] = 'Ups!, No se pudo hacer la solicitud =/';
        $json['data'] = null;
        $json['errors'] = $errors;
        $json['ok'] = false;
        $json['status'] = 422;

        throw new HttpResponseException
        (
            response()->json($json, 422)
        );
    }
}
