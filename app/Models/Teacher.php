<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SocialProfile;
use App\Models\Objective;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Teacher extends Model implements Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, AuthenticatableTrait;

    protected $table = 'teacher';
    public $timestamps = false ;
    protected $primaryKey = 'teacherid' ;
    //public $incrementing = true ;
    //protected $keyType = 'int' ;

    public $fillable = [
        'name',
        'lastname',
        'universityid',
        'email',
        'cellphonenumber',
        'contract',
        'userid',
    ];

    public function socialProfiles() {
        return $this->hasMany(SocialProfile::class);
    }

    public function objectives(){
        return $this->hasMany(Teacher::class , 'teacherid' , 'teacherid');
    }

}
