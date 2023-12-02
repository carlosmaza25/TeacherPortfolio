<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use App\Models\Objective;

class CycleDetail extends Model
{
    use HasFactory;

    protected $table = 'cycledetail';
    public $timestamps = false ;
    protected $primaryKey = 'cycledetailid' ;
   // public $incrementing = true ;
    //protected $keyType = 'int' ;

    protected $fillable = [
        'cycleid',
        'since',
        'until',
        'year',
    ];

    public function SubjectDetail() {
        return $this->hasMany(SubjectDetail::class , 'cycledetailid' , 'cycledetailid');
    }

    public function objectives(){
        return $this->hasMany(Objective::class , 'cycledetailid' , 'cycledetailid');;
    }
}
