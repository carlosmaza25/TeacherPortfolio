<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicSubject extends Model
{
    use HasFactory;

    protected $table = 'topicsubject';
    public $timestamps = false ;
    protected $primaryKey = 'id' ;
    //public $incrementing = true ;
    //protected $keyType = 'int' ;

    public function topics () {
        return $this->hasMany(Topic::class , 'topicid' , 'topicid');
    }
}
