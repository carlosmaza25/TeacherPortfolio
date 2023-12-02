<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskType extends Model
{
    use HasFactory;

    protected $table = 'tasktype';
    public $timestamps = false ;
    protected $primaryKey = 'tasktypeid' ;
    //public $incrementing = true ;
    //protected $keyType = 'int' ;
}
