<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $table = 'period';
    public $timestamps = false ;
    protected $primaryKey = 'periodid' ;
    //public $incrementing = true ;
    //protected $keyType = 'int' ;
}
