<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubjectDetail;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subject';
    public $timestamps = false ;
    protected $primaryKey = 'subjectid' ;
    public $incrementing = true ;
    protected $keyType = 'int' ;

    protected $fillable = [
        'description',
        'nickname',
    ];
}
