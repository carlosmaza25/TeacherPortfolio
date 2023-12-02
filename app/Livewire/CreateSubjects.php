<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Subject;
use App\Models\SubjectDetail;
use App\Models\Schedule;
use App\Models\Section;
use App\Models\CycleDetail;
use App\Validation\CustomValidationMessages;

class CreateSubjects extends Component
{

    public $isOpen = false ;
    public $subjectid , $teacherid , $sectionid , $cycleid;
    public $scheduleid;
    public $detailSchedule;
    public $scheduleDay , $scheduleSince , $scheduleUntil;
    public $classroom;
    public $rules ;
    public $messages;

    public function __construct()
    {
        $validationMessages = new CustomValidationMessages();

        $this->rules = $validationMessages::rules();
        $this->messages = $validationMessages::messages();
    }

    public function save() {

        $subject = Subject::where('description' , $this->subjectid)->first() ;
        $this->teacherid = session('id');
        $section = Section::where('classsection' , $this->sectionid)->first();
        $this->cycleid = CycleDetail::orderBy('cycledetailid', 'desc')->first();
        $this->detailSchedule = explode('-' , $this->scheduleid);

        $this->validate();

        $this->scheduleDay = $this->detailSchedule[0];
        $this->scheduleSince = $this->detailSchedule[1];
        $this->scheduleUntil = $this->detailSchedule[2] ;
        $scheduleSubjectTeacher = Schedule::where('day' , $this->scheduleDay)->where('since' , $this->scheduleSince)->where('until' , $this->scheduleUntil)->first();

        SubjectDetail::create([
            'subjectid' => $subject->subjectid,
            'sectionid' => $section->sectionid,
            'teacherid' => $this->teacherid,
            'cycledetailid' => $this->cycleid->cycledetailid,
            'scheduleid' => $scheduleSubjectTeacher->id,
            'classroom' => $this->classroom
        ]);

        if (session('usertype') == 1){
            return redirect()->route('subject.admin' , $this->cycleid);
        }
            return redirect()->route('home.index' , $this->cycleid) ;
    }

    public function render()
    {

        $subjects = Subject::all() ;
        $schedules = Schedule::all();
        $sections = Section::all();

        return view('livewire.create-subjects' ,  compact('subjects' , 'schedules' , 'sections'));
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetValidation();
    }

    public function classroomChanged(){
        $this->classroom;
        $this->resetValidation('classroom');
    }

    public function subjectidChanged(){
        $this->subjectid;
        $this->resetValidation('subjectid');
    }

    public function scheduleidChanged(){
        $this->scheduleid;
        $this->resetValidation('scheduleid');
    }

    public function sectionidChanged(){
        $this->sectionid;
        $this->resetValidation('sectionid');
    }

}
