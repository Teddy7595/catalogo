<?php

namespace App\Http\Requests\Quote;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class QuoteCreateRequest extends FormRequest
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
            'bsdls' => 'string|required',
            'bseur' => 'string|required',
        ];
    }

    public function messages()
    {
        return
        [
            'bsdls.required' => 'La cotización de bs por $ es obligatorio',
            'bseur.required' => 'La cotización de bs por eur es obligatorio' 
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
