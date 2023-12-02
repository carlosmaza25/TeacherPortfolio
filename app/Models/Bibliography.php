<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bibliography extends Model
{
    use HasFactory;

    protected $table = 'bibliography';
    public $timestamps = false ;
    protected $primaryKey = 'bibliographyid' ;
    //public $incrementing = true ;
    //protected $keyType = 'int' ;

    protected $fillable = [
        'bookid',
        'teacherid',
        'subjectid',
        'cycledetailid',
    ];

    public function books () {
        return $this->hasMany(Book::class , 'bookid' , 'bookid');
    }
}
