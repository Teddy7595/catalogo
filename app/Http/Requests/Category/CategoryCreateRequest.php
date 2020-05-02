<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoryCreateRequest extends FormRequest
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
            'name' => 'string|required|unique:App\Models\Category',
            'department' => 'string|required|unique:App\Models\Category',
        ];
    }

    public function messages()
    {
        return
        [
            'name.required' => 'El nombre de la categoria es obligatorio',
            'department.required' => 'El departamento de la categoria es obligatorio' 
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
