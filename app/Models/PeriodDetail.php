<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodDetail extends Model
{
    use HasFactory;

    protected $table = 'perioddetail';
    public $timestamps = false ;
    protected $primaryKey = 'perioddetailid' ;
    //public $incrementing = true ;
    //protected $keyType = 'int' ;

    protected $fillable = [
        'cycleid',
        'periodid',
        'since',
        'until',
        'year',
    ];
}
