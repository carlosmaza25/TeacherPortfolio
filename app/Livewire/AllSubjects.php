<?php

namespace App\Livewire;

use App\Models\Careers;
use App\Models\CurriculumCareer;
use App\Models\CurriculumSubject;
use App\Models\Subject;
use App\Validation\ValidationSubject;
use Livewire\Component;
use Livewire\WithPagination;

class AllSubjects extends Component
{
    use WithPagination;

    public $searchsubjects;
    public $openmodal = false , $openupdatesubject = false;
    public $subjects1 , $careers , $subjecttoupdate;
    public $name , $nickname , $career , $valueunit , $prerequisite , $opento , $hours , $cyclenumber;
    public $careerdescription , $prerequisitedescription , $opentodescription;
    public $messages , $rules;

    public function mount() {
        $this->subjects1 = Subject::all();
        $this->careers = Careers::all();
    }

    public function render()
    {
        $subjects = CurriculumSubject::whereHas('subjects' , function($query) {
            $query->where('description' , 'ilike' , '%' . $this->searchsubjects . '%');
        })->paginate(10);
        return view('livewire.all-subjects' , compact('subjects'));
    }

    public function save() {
        $validationsubject = new ValidationSubject();
        $this->messages = $validationsubject::messages();
        $this->rules = $validationsubject::rules();
        $this->validate();
        Subject::create([
            'description' => $this->name,
            'nickname' => $this->nickname,
        ]);

        $curriculumcareerid = CurriculumCareer::where('careerid' , $this->career)->where('curriculumid' , 1)->first();

        $subjectid = Subject::orderBy('subjectid' , 'desc')->first();

        CurriculumSubject::create([
            'curriculumcareerid' => $curriculumcareerid->curriculumcareerid,
            'subjectid' => $subjectid->subjectid,
            'valueunit' => $this->valueunit,
            'prerequisiteid' => $this->prerequisite,
            'opentoid' => $this->opento,
            'hours' => $this->hours,
            'cyclenumber' => $this->cyclenumber,
        ]);

        return redirect()->route('allsubject.index');
    }

    public function openUpdateSubject ($id){
        $this->openupdatesubject = true;
        $this->subjecttoupdate = CurriculumSubject::find($id);
        $subjectid = Subject::find($this->subjecttoupdate->subjectid);
        $this->name = $subjectid->description;
        $this->nickname = $subjectid->nickname;
        $curriculumcareerid = $this->subjecttoupdate->curriculumcareerid;
        $careerid = CurriculumCareer::find($curriculumcareerid);
        $this->careerdescription = Careers::find($careerid->careerid);
        $this->career = $this->careerdescription->careerid;
        $this->valueunit = $this->subjecttoupdate->valueunit;
        $this->prerequisitedescription = Subject::find($this->subjecttoupdate->prerequisiteid);
        $this->prerequisite = $this->prerequisitedescription->subjectid;
        $this->opentodescription = Subject::find($this->subjecttoupdate->opentoid);
        $this->opento = $this->opentodescription->subjectid;
        $this->hours = $this->subjecttoupdate->hours;
        $this->cyclenumber = $this->subjecttoupdate->cyclenumber;
    }

    public function updateSubject() {
        $registercurriculumsubject = $this->subjecttoupdate;
        $registersubject = Subject::find($this->subjecttoupdate->subjectid);
        $validationsubject = new ValidationSubject();
        $this->rules = $validationsubject::rules();
        $this->messages = $validationsubject::messages();
        $this->validate();

        $registersubject->description = $this->name;
        $registersubject->nickname = $this->nickname;
        $registersubject->save();
        
        $curriculumcareerid = CurriculumCareer::where('careerid' , $this->career)->where('curriculumid' , 1)->first();

        $registercurriculumsubject->curriculumcareerid = $curriculumcareerid->curriculumcareerid;
        $registercurriculumsubject->subjectid = $registersubject->subjectid;
        $registercurriculumsubject->valueunit = $this->valueunit;
        $registercurriculumsubject->prerequisiteid = $this->prerequisite;
        $registercurriculumsubject->opentoid = $this->opento;
        $registercurriculumsubject->hours = $this->hours;
        $registercurriculumsubject->cyclenumber = $this->cyclenumber;
        $registercurriculumsubject->save();
    }

    public function searchSubjectChanged() {
        $this->searchsubjects;
    }

    public function careerChanged(){
        $this->career;
    }

    public function openModal () {
        $this->openmodal = true ;
    }

    public function closeModal() {
        $this->openmodal = false ;
        $this->resetValidation();
    }

    public function closeModalUpdate(){
        $this->openupdatesubject = false;
        $this->resetValidation();
        $this->name = '';
        $this->nickname = '';
        $this->career = '';
        $this->valueunit = '';
        $this->prerequisite = '';
        $this->opento = '';
        $this->hours = '';
        $this->cyclenumber = '';
    }
}
