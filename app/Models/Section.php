<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
//schedulesubjectteacher
    protected $table = 'classsection';
    public $timestamps = false ;
    protected $primaryKey = 'sectionid' ;
    //public $incrementing = true ;
    //protected $keyType = 'int' ;

    protected $fillable = [
        'sectionid',
        'classsection',
    ];
}
