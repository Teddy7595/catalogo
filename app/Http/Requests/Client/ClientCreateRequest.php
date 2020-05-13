<?php

namespace App\Http\Requests\Client;

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
    
    public function rules()
    {
        return 
        [
            //SE CREA LAS REGLAS DE VALIDACION DEL REQUEST
            'adress1' => 'string|required',
            'adress2' => 'string',
            'phone1' => 'string|required',
            'phone2' => 'string'
        ];
    }

    public function messages()
    {
        return
        [
            'phone1.required' => 'Se debe tener al menos un dato de teléfono para contacto',
            'adress1.required' => 'Se debe tener al menos un dato para de dirección de contacto', 
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
