<?php

/*
|--------------------------------------------------------------------------
| Validaciones del formulario de la sección Customer's
|--------------------------------------------------------------------------
|
| **authorize: determina si el usuario debe estar autorizado para enviar el formulario. 
|
| **rules: recoge las normas que se deben cumplir para validar el formulario. Los errores son 
|   devueltos en forma de objeto JSON en un error 422.
| 
| **messages: mensajes personalizados de error.
|    
*/

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'direction' => 'required',
            'cp' => 'required',
            'location' => 'required',
            'phone' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'surname.required' => 'El nombre es requerido',
            'email.required' => 'El nombre es requerido',
            'cp.required' => 'El nombre es requerido',
            'direction.required' => 'El nombre es requerido',
            'location.required' => 'El nombre es requerido',
            'phone.required' => 'El nombre es requerido',
        ];
    }
}
