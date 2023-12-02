<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;
use App\Models\CycleDetail;

class SubjectDetail extends Model
{
    use HasFactory;

    protected $table = 'subjectdetail';
    public $timestamps = false ;
    protected $primaryKey = 'subjectdetailid' ;
    //public $incrementing = true ;
    //protected $keyType = 'int' ;

    protected $fillable = [
        'subjectid',
        'sectionid',
        'teacherid',
        'cycledetailid',
        'scheduleid',
        'classroom',
    ];

    public function subjects() {
        return $this->hasMany(Subject::class , 'subjectid' , 'subjectid');
    }

    public function Cycle() {

        return $this->belongsTo(CycleDetail::class , 'cycledetailid' , 'cycledetailid');
    }

    public function CycleDettail() {
        return $this->belongsTo(CycleDetail::class , 'cycledetailid' , 'cycledetailid');
    }
    public function schedules() {
        return $this->hasMany(Schedule::class , 'id' , 'scheduleid');
    }
    public function sections () {
        return $this->hasMany(Section::class , 'sectionid' , 'sectionid');
    }
}
