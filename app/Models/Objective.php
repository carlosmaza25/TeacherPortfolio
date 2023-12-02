<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;

class Objective extends Model
{
    use HasFactory;

    protected $table = 'objective';
    public $timestamps = false ;
    protected $primaryKey = 'objectiveid' ;
   // public $incrementing = true ;
    //protected $keyType = 'int' ;

    protected $fillable = [
        'teacherid' ,
        'subjectid',
        'cycledetailid',
        'description',
    ];
}
