<?php

namespace App\Validation;

class ValidationBook
{
    public static function rules()
    {
        return [

            'title' => 'required' , 
            'author' => 'required' ,
            'edition' => 'required',
            'year' => 'required|numeric|min:4',
        ];
    }

    public static function messages()
    {
        return [

            'title' => 'Debe colocar el titulo del libro' ,
            'author' => 'Debe coloca el autor del libro' ,
            'edition' => 'Coloque la edicion del libro',
            'year.required' => 'debe colocar el años de lanzamiento del libro.',
            'year.numeric' => 'el año del libro debe ser numerico y un entero.',
            'year.min' => 'espcifique el año del libro con los 4 digitos',

        ];
    }
}