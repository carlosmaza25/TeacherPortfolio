<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectDetail;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\CycleDetail;
use App\Models\SocialProfile;

class HomeController extends Controller
{

    public function index($cycleid) {

        $id = session('id');
        $name = session('name');
        $socialProfile =  SocialProfile::where('teacherid' , $id)->first() ;

        if (session('usertype') == 1) {
            return view('Admin.homeadmin' , compact('id' , 'name' , 'socialProfile')) ;

        }else {

            $subjects = SubjectDetail::where('teacherid' , $id)
            ->where('cycledetailid' , $cycleid)->get() ;

            $cycles = CycleDetail::find($cycleid);
    
            $cycleinfo = 'Ciclo' . ' ' . $cycles->cycleid . ' ' . $cycles->year;

            $cycledetail = CycleDetail::orderBy('cycledetailid' , 'desc')->skip(1)->get();
            $lastcycle = CycleDetail::orderBy('cycledetailid' , 'desc')->first();
    
            return view('Teacher.hometeacher' , 
                        compact('subjects' , 'cycleinfo' , 'id' , 
                        'name' , 'socialProfile' ,'cycledetail' 
                        , 'lastcycle', 'cycles'));
        }
    }
}