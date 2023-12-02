<?php

namespace App\Validation;

class ValidationBibliography
{
    public static function rules()
    {
        return [
            'subjectselected' => 'required',
        ];
    }

    public static function messages()
    {
        return [
            'subjectselected.required' => 'No se ha seleccionado la materia...'
        ];
    }
}