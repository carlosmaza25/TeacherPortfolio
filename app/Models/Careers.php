<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Careers extends Model
{
    use HasFactory;

    protected $table = 'career';
    public $timestamps = false ;
    protected $primaryKey = 'careerid' ;
    //public $incrementing = true ;
    //protected $keyType = 'int' ;
}
