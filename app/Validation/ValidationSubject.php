<?php

namespace App\Validation;

class ValidationSubject
{
    public static function rules()
    {
        return [
            'name' => 'required',
            'prerequisite' => 'required',
            'opento' => 'required',
            'career' => 'required',
            'valueunit' => 'required' ,
            'hours' => 'required' ,
            'cyclenumber' => 'required',
        ];
    }

    public static function messages()
    {
        return [
            'name.required' => 'Se requiere el nombre de la materia',
            'prerequisite.required' => 'Seleccione una materia',
            'opento.required' => 'Seleccione una materia',
            'career.required' => 'Seleccine la carrera',
            'valueunit.required' => 'Se requiere las unidades valorativas',
            'hours.required' => 'Digite el numero de horas',
            'cyclenumber.required' => 'Se requiere El numero de ciclo es en el que la materia es impartida',
        ];
    }
}