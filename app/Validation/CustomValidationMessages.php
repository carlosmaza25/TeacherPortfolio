<?php

namespace App\Validation;

class CustomValidationMessages
{
    public static function rules()
    {
        return [
            'subjectid' => 'required',
            'sectionid' => 'required',
            'scheduleid' => 'required',
            'scheduleidone' => 'required',
            'classroom' => 'required',
        ];
    }

    public static function messages()
    {
        return [
            'subjectid.required' => 'El campo de la materia es obligatorio.',
            'sectionid.required' => 'El campo de la sección es obligatorio.',
            'scheduleid.required' => 'El campo del horario es obligatorio.',
            'scheduleidone.required' => 'Se requieren al menos un segundo horario.',
            'classroom.required' => 'El campo del aula es obligatorio.',
        ];
    }
}