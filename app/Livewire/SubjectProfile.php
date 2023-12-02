<?php

namespace App\Livewire;

use App\Models\CycleDetail;
use App\Models\PeriodDetail;
use App\Models\SubjectDetail;
use App\Models\TopciTeacher;
use Livewire\Component;
use Mockery\CountValidator\Exception;
use PhpParser\Node\Stmt\TryCatch;

class SubjectProfile extends Component
{
    public $subjects;
    public $cycle;
    public $id ;

    public function mount($id) {
        $this->id = $id;
        $this->cycle = CycleDetail::orderBy('cycledetailid' , 'desc')->first();
        $this->subjects =  SubjectDetail::where('teacherid' , $id)->where('cycledetailid' , $this->cycle->cycledetailid)->get();
    }

    public function render()
    {
        $subjects = $this->subjects;
        return view('livewire.subject-profile' , compact('subjects'));
    }

    public function Advance($id) {
        $totaltopic = 0;
        $topicfinalized = 0;
        $advance = 0 ;
        $cycleid = $this->cycle->cycleid;
        $year = $this->cycle->year;
        $periodsdetail = PeriodDetail::where('cycleid' , $cycleid)
                                    ->where('year' , $year)->pluck('perioddetailid')->toArray();

        foreach ($periodsdetail as $periodDetailId) {
                $totaltopic += TopciTeacher::where('teacherid', $this->id)
                                        ->where('perioddetailid', $periodDetailId)
                                        ->where('subjectid', $id)
                                        ->count();

                $topicfinalized += TopciTeacher::where('teacherid', $this->id)
                                                ->where('perioddetailid', $periodDetailId)
                                                ->where('subjectid', $id)
                                                ->where('status' , 1)
                                                ->count();
        }

        if ($totaltopic != 0) {
            $advance = ($topicfinalized * 100) / $totaltopic;
        } else {
            $advance = 100;
        }

        return $advance ;
        
    }
}
