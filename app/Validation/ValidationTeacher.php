<?php

namespace App\Validation;

class ValidationTeacher
{
    public static function rules()
    {
        return [
            'name' => 'required',
            'lastname' => 'required',
            'universityid' => 'required',
            'email' => 'required',
            'cellphonenumber' => 'required|regex:/^503-\d{4}-\d{4}$/|max:13',
            'contract' => 'required|string|different:Seleccione una Opcion',
            'userid' => 'required',
        ];
    }

    public static function messages()
    {
        return [
            'name.required' => 'Introduzca el nombre del docente',
            'lastname.required' => 'Introduzca el los apellidos del docente',
            'universityid.required' => 'Introduzca el Carnet',
            'email.required' => 'Introduzca el email',
            'cellphonenumber.required' => 'Introduzca un numero de telefono',
            'cellphonenumber.regex' => 'el formato es incorrecto. El formato debe ser ####-####',
            'cellphonenumber.max' => 'No debe exceder los 13 caracteres',
            'contract.required' => 'Seleccion el tipo de contrato',
            'contract.different' => 'Seleccion el tipo de contrato',
            'userid.required' => 'Seleccione el tipo de usuario',
        ];
    }
}