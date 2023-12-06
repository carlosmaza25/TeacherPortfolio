<?php

namespace App\Http\Controllers;

use App\Models\CycleDetail;
use App\Models\Objective;
use App\Models\Period;
use App\Models\PeriodDetail;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Models\SocialProfile;
use App\Models\Subject;
use App\Models\SubjectDetail;
use App\Models\TopciTeacher;
use App\Models\Topic;

class SubjectController extends Controller
{
    public function index($subjectId , $cycleid) {

        $plantilla = false;;
        $name = session('name') ; 
        $schedule = "";

        $id = session('id');
        $subject = Subject::find($subjectId);
        $subjectdetail = SubjectDetail::where('subjectid' , $subjectId)
                        ->where('teacherid' , session('id'))
                        ->where('cycledetailid' , $cycleid)->first();
        $scheduleid = Schedule::where('id' , $subjectdetail->scheduleid)->first();
        $scheduleidone = Schedule::where('id' , $subjectdetail->scheduleidone)->first();
        
        // ----------------------------------------------Valida si existe un tercer horario y en caso de no existir no lo toma en cuenta para mostrarlo //---------------------------
        if ($scheduleidone === null) {
            $schedule =  $schedule = $scheduleid->day . ' de ' . $scheduleid->since . ' a ' . $scheduleid->until ;
        }
        else {
            $schedule = $scheduleid->day . ' de ' . $scheduleid->since . ' a ' . $scheduleid->until . ' y ' . 
            $scheduleidone->day . ' de ' . $scheduleidone->since . ' a ' . $scheduleidone->until;
        }

        $socialProfile = SocialProfile::where('teacherid' , $id)->first() ;
        $cycle = CycleDetail::find($cycleid);
        $informationcycle = 'Ciclo' . $cycle->cycleid . '-' . $cycle->year;
        $objectivesteacher = Objective::where('teacherid' , session('id'))
                            ->where('cycledetailid' , $cycleid)
                            ->where('subjectid' , $subjectId)->get();
        
        $periods = Period::all();
        $perioddetailid = PeriodDetail::where ('periodid' , 1)
                        ->where('cycleid' , $cycle->cycleid)
                        ->where('year' , $cycle->year)->first();
        $topicsteacher = TopciTeacher::where('teacherid' ,  session('id'))
                        ->where('perioddetailid' , $perioddetailid->perioddetailid)
                        ->where('subjectid' , $subjectId)->orderBy('date' , 'asc')->get();

        if (session('usertype') == 1) {
            $plantilla = true ;
        }else {
            $plantilla = false;
        }

        return view('Subject.subject' , 
                    compact('name' , 'socialProfile' , 
                    'plantilla' , 'subject' , 'informationcycle',
                    'subjectdetail', 'schedule' , 'objectivesteacher',
                    'periods', 'topicsteacher' ,'cycle' , 'subjectId'));
    }
}
