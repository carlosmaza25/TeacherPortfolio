<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TaskType;

class TaskTeacher extends Model
{
    use HasFactory;

    protected $table = 'taskteacher';
    public $timestamps = false ;
    protected $primaryKey = 'taskteacherid' ;
    //public $incrementing = true ;
    //protected $keyType = 'int' ;

    protected $fillable = [
        'tasktypeid',
        'objective' ,
        'description',
        'perioddetailid',
        'percentage',
        'status',
        'date',
        'teacherid',
        'subjectid',
    ];

    public function tasks() {
        return $this->hasMany(TaskType::class , 'tasktypeid' , 'tasktypeid');
    }
}
