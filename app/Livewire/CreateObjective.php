<?php

namespace App\Livewire;

use App\Models\Objective;
use App\Models\TopicSubject;
use Livewire\Component;

class CreateObjective extends Component
{

    public $isOpen = false;
    public $cycleid ;
    public $subjecid ;
    public $description ;

    public function mount($cycle , $subjectid) {
        $this->cycleid =  $cycle->cycledetailid;
        $this->subjecid = $subjectid;
    }

    public function save(){
        Objective::create([
            'teacherid' => session('id'),
            'subjectid' => $this->subjecid,
            'cycledetailid' => $this->cycleid,
            'description' => $this->description,
        ]);

        return redirect()->route('subject.index' , ['subjectId' => $this->subjecid , 'cycleid' => $this->cycleid]);
    }

    public function render()
    {
        return view('livewire.create-objective');
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }
}
