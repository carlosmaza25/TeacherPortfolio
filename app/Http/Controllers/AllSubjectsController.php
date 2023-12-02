<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialProfile;

class AllSubjectsController extends Controller
{
    public function index(){
        $id = session('id');
        $socialProfile =  SocialProfile::where('teacherid' , $id)->first() ;
        $name = session('name');

        return view('Admin.allsubjects' , compact('socialProfile' , 'name'));
    }
}
