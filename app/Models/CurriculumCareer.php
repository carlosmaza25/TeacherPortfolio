<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumCareer extends Model
{
    use HasFactory;

    protected $table = 'curriculumcareer';
    public $timestamps = false ;
    protected $primaryKey = 'curriculumcareerid' ;
    //public $incrementing = true ;
    //protected $keyType = 'int' ;
}
