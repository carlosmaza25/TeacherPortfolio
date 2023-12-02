<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialProfile;
use App\Models\SubjectDetail;
use Illuminate\Queue\Listener;
use App\Models\CycleDetail;

class AdminController extends Controller
{

    public function index ($cycleid){

        
        $id = session('id');
        $name = session('name');

        $socialProfile =  SocialProfile::where('teacherid' , $id)->first() ;

        $subjects = SubjectDetail::where('teacherid' , $id)
        ->where('cycledetailid' , $cycleid)->get() ;

        $cycles = CycleDetail::find($cycleid);

        $cycleinfo = 'Ciclo' . ' ' . $cycles->cycleid . ' ' . $cycles->year;

        $cycledetail = CycleDetail::orderBy('cycledetailid' , 'desc')->skip(1)->get();
        $lastcycle = CycleDetail::orderBy('cycledetailid' , 'desc')->first();

        return view('Admin.subjectadmin' , 
                    compact('subjects' , 'cycleinfo' , 'id' , 
                            'name' , 'socialProfile' ,'cycledetail' 
                            ,'lastcycle', 'cycles'));
    }
}
