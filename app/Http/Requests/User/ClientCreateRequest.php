<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ClientCreateRequest extends FormRequest
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
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|unique:App\Models\User',
            'ci' => 'string|required',
            'adress1' => 'string|required',
            'phone1' => 'string|rquired'
        ];
    }

    public function messages()
    {
        return
        [
            'name.required' => 'El nombre es obligatorio',
            'password.required' => 'El password es obligatorio',
            'email.required' => 'El email es obligatorio',
            'ci.required' => 'El codigo de identificación es obligatorio',
            'phone1.required' => 'Es obligatorio un nro telefónico',
            'adress.required' => 'Es obligatorio una dirección'  
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
