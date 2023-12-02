<?php

namespace App\Livewire;

use App\Models\CycleDetail;
use App\Models\PeriodDetail;
use Livewire\Component;

class EditCycle extends Component
{
    public $isOpen = false ;
    public $period;
    public $cycleid , $periodid , $since , $until ,$year;

    public function mount($id) {
        $this->period = $id;
    }

    public function render()
    {
        $periodtoedit = PeriodDetail::find($this->period);
        return view('livewire.edit-cycle' , compact('periodtoedit'));
    }

    public function updatePeriod() {
        $periodtoupdate = PeriodDetail::find($this->period);
        $cycledetail = CycleDetail::where('cycleid' , $periodtoupdate->cycleid)->where('year' , $periodtoupdate->year);
        $periodtoupdate->since = $this->since;
        $periodtoupdate->until = $this->until;
        $this->year = explode('-' , $this->since);
        $periodtoupdate->year = $this->year[0];
        $periodtoupdate->save();
    }

    public function openModal(){
        $periodtoupdate = PeriodDetail::find($this->period);
        $this->isOpen = true ;
        $this->since = $periodtoupdate->since;
        $this->until = $periodtoupdate->until;
    }

    public function closeModal() {
        $this->isOpen = false;
    }
}
