<?php

namespace App\Validation;

class ValidationTopic
{
    public static function rules()
    {
        return [
            'topicselected' => 'required',
            'date' => 'required',
        ];
    }

    public static function messages()
    {
        return [
            'topicselected.required' => 'debe seleccionar el tema',
            'date.required' => 'debe seleccionar una fecha',
        ];
    }
}