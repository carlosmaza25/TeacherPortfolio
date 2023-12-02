<?php

namespace App\Livewire;

use App\Models\Teacher;
use App\Validation\ValidationTeacher;
use App\Models\CycleDetail;
use Livewire\WithPagination;
use Livewire\Component;
use PHPUnit\Event\Code\Test;

class HomeAdmin extends Component
{

    use WithPagination;
    
    public $openmodal = false ;
    public $name , $lastname , $universityid , $email , $cellphonenumber = '503-';
    public $contract , $userid ;
    public $rules , $messages;
    public $searchteacher = '';
    public $count;

    public function updatingSearchteacher(){
        $this->resetPage();
    }

    public function render()
    {
        $teachers = Teacher::where('name' , 'ilike' , '%' . $this->searchteacher . '%')
                            ->orWhere('universityid' , 'ilike' , '%' . $this->searchteacher . '%')->orderBy('teacherid' , 'desc')->paginate(10);
        return view('livewire.home-admin' , compact('teachers'));
    }

    public function save() {
        $cycleid = CycleDetail::orderBy('cycledetailid' , 'desc')->first();
        $usertype = 0;
        $validation = new ValidationTeacher();
        $this->rules = $validation::rules();
        $this->messages = $validation::messages();

        $this->validate();

        if($this->userid === 'Administrador'){
            $usertype = 1 ;
        }
        else {
            $usertype = 2 ;
        }

        if ($this->contract === 'Seleccione una Opcion'){
            $this->messages = 'Seleccione el tipo de contrato';
        }
        else {

            Teacher::create([
                'name' => $this->name,
                'lastname' => $this->lastname,
                'universityid' => $this->universityid,
                'email' => $this->email,
                'cellphonenumber' => $this->cellphonenumber,
                'contract' =>$this->contract,
                'userid' => $usertype,
            ]);

            return redirect()->route('home.index' , ['cycleid' => $cycleid]);

        }
    }

    public function deleteTeacher($id) {
        $teachertodelete = Teacher::find($id) ;
        $teachertodelete->delete() ;
    }

    public function nameChanged() {
        $this->name;
    }

    public function lastNameChanged() {
        $this->lastname;
    }

    public function universityIdChanged() {
        $this->universityid;
    }

    public function emailChanged() {
        $this->email;
    }

    public function cellphoneNumberChanged() {

        $this->cellphonenumber = preg_replace('/[^0-9-]/', '', $this->cellphonenumber); 

        if (strlen($this->cellphonenumber) < 4){
            $this->cellphonenumber = '503-';
        }
    }

    public function contractChanged() {
        $this->contract;
        $this->resetValidation('contract');
    }

    public function userIdChanged() {
        $this->userid;
    }

    public function searchTeacherChanged(){
        $this->searchteacher;
    }

    public function openModal () {
        $this->openmodal = true;
    }

    public function closeModal () {
        $this->openmodal = false;
        $this->resetValidation();
        $this->messages = null ;
    }
}
