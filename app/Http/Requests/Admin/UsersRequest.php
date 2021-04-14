<?php

/*
|--------------------------------------------------------------------------
| Validaciones del formulario de la sección User's
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

class UsersRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required', 
            'email' => 'required',
            'password' => 'required_without:id|confirmed',
            'password_confirmation' => 'required | same:password',
    
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'email.required' => 'Debes introducir un correo electrónico',
            'password.required' => "Debes introducir una contraseña"
        ];
    }
}
