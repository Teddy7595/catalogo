<?php

namespace App\Http\Requests\Bank;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;


class BankCreateRequest extends FormRequest
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
            'prefix' => 'required|unique:App\Models\Bank',
            'email' => 'string|required',
            'titular' => 'string|required',
            'phone' => 'string|required',
            'cod' => 'string|required',
            'type' => 'string|required',
            'ci' => 'string|required'
        ];
    }

    public function messages()
    {
        return
        [
            'name.required' => 'El nombre del banco es requerido para registrar la cuenta bancaria',
            'prefix.required' => 'Los primeros 4 numeros del banco son requerido para registrar el banco',
            'cod.required' => 'El nro de cuenta es requerido para registrar el banco',
            'titular.required' => 'El nombre del titular es requerido para registrar el banco',
            'phone.required' => 'El numero de telefno del titular es requerido para registrar el banco',
            'email.required' => 'El email del titular es requerido para registrar el banco',
            'type.required' => 'El tipo de cuenta es requerido para registrar el banco',
            'ci.required' => 'La cédula del titular es requerido para registrar el banco' 
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
