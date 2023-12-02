<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $table = 'topic';
    public $timestamps = false ;
    protected $primaryKey = 'topicid' ;
    //public $incrementing = true ;
    //protected $keyType = 'int' ;
    
}
