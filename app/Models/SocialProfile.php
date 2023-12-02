<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;

class SocialProfile extends Model
{
    use HasFactory;

    protected $table = 'socialprofile';
    public $timestamps = false ;
    protected $primaryKey = 'socialprofileid' ;

    protected $fillable =[
        'socialprofileid',
        'teacherid' ,
        'socialid',
        'socialavatar',
    ];

    public function user(){
        $this->belongsTo(Teacher::class);
    }
}
