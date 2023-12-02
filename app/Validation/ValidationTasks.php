<?php

namespace App\Validation;

class ValidationTasks
{
    public static function rules()
    {
        return [

            'taskselected' => 'required' , 
            'percentage' => 'required|numeric|min:1|max:50' ,
            'datetask' => 'required',
        ];
    }

    public static function messages()
    {
        return [

            'taskselected' => 'Debe seleccionar una evaluaciónn' ,
            'percentage.required' => 'La evaluacion requiere un porcentaje' ,
            'percentage.numeric' => 'El campo porcentaje debe ser un número.',
            'percentage.min' => 'El campo porcentaje debe ser mayor o igual a :min.',
            'percentage.max' => 'El campo porcentaje debe ser menor o igual a :max.',
            'datetask' => 'Debe establecer una fecha',

        ];
    }
}