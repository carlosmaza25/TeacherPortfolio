<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumSubject extends Model
{
    use HasFactory;

    protected $table = 'curriculumsubject';
    public $timestamps = false ;
    protected $primaryKey = 'curriculumsubjectid' ;
    //public $incrementing = true ;
    //protected $keyType = 'int' ;

    protected $fillable = [
        'curriculumcareerid',
        'subjectid',
        'valueunit',
        'prerequisiteid',
        'opentoid',
        'hours',
        'cyclenumber',
    ];

    public function subjects () {
        return $this->hasMany(Subject::class , 'subjectid' , 'subjectid');
    }
}
