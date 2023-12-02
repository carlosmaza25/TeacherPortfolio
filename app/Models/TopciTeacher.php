<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Topic;

class TopciTeacher extends Model
{
    use HasFactory;

    protected $table = 'topicteacher';
    public $timestamps = false ;
    protected $primaryKey = 'topicteacherid' ;
    //public $incrementing = true ;
    //protected $keyType = 'int' ;

    protected $fillable = [
        'teacherid',
        'topicid',
        'perioddetailid',
        'date',
        'subjectid',
    ];

    public function topics(){
        return $this->hasMany(Topic::class , 'topicid' , 'topicid');
    }
}
