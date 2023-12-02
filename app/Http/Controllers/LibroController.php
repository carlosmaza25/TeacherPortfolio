<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\CycleDetail;
use App\Models\SubjectDetail;
use App\Models\SocialProfile;

class LibroController extends Controller 
{

    public function index(){

        $plantilla = '';

        $name = session('name') ;

        $id = session('id');

        $lastimecycle = CycleDetail::latest('cycledetailid')->first()->cycledetailid;
        $subjects = SubjectDetail::where('teacherid' , $id)
                                    ->where('cycledetailid' , $lastimecycle)->get() ;
        $socialProfile = SocialProfile::where('teacherid' , $id)->first() ;

        if (session('usertype') == 1) {
            $plantilla = true ;
        }else {
            $plantilla = false;
        }

        return view('Libro.index' , compact('name' , 'subjects' , 'socialProfile' , 'plantilla'));
    }
}
