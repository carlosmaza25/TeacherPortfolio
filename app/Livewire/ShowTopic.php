<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PeriodDetail;
use App\Models\TaskTeacher;
use App\Models\TaskType;
use App\Models\TopciTeacher;
use App\Models\Topic;
use App\Models\TopicSubject;
use App\Validation\ValidationTasks;
use App\Validation\ValidationTopic;
use Carbon\Carbon;
use Illuminate\Console\View\Components\Task;

class ShowTopic extends Component
{

    public $optionSelected = 1 ;
    public $period ;
    public $topicsteacher ;
    public $periodid;
    public $cycle;
    public $subjectId;
    public $click = false;
    public $statustask = 'fas fa-edit' , $statustopic = 'fas fa-edit';
    public $option;
    public $taskteacher;
    public $openTopic = false ;
    public $openTask = false ;
    public $topicssubject ;
    public $topicselected , $rules , $messages , $date;
    public $taskselected , $percentage , $objective , $description , $status , $datetask , $tasks;
    public $currentdate;
    public $isOpenTopic = false , $topictoupdate , $topicname;
    public $isOpenTask = false , $tasktoupdate , $taskname ;
    
    public function mount($periods , $topicsteacher, $cycle, $subjectId) {
        $this->period = $periods;
        $this->topicsteacher = $topicsteacher;
        $this->optionSelected = 1;
        $this->cycle = $cycle;
        $this->subjectId = $subjectId;
        $this->topicssubject = TopicSubject::where('subjectid' , $subjectId)->get();
        $this->tasks =  TaskType::all();
        $this->currentdate =  Carbon::now()->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.show-topic');
    }

    public function optionSelectedChanged() {
        $this->optionSelected;
        if ($this->click){
            $this->periodid = PeriodDetail::where ('periodid' , $this->optionSelected)
                            ->where('cycleid' , $this->cycle->cycleid)
                            ->where('year' , $this->cycle->year)->first();
            $this->taskteacher = TaskTeacher::where('teacherid' ,  session('id'))
                                ->where('perioddetailid' , $this->periodid->perioddetailid)
                                ->where('subjectid' , $this->subjectId)->get();
        }else {
            $this->periodid = PeriodDetail::where ('periodid' , $this->optionSelected)
                ->where('cycleid' , $this->cycle->cycleid)
                ->where('year' , $this->cycle->year)->first();
            $this->taskteacher = TaskTeacher::where('teacherid' ,  session('id'))
                ->where('perioddetailid' , $this->periodid->perioddetailid)
                ->where('subjectid' , $this->subjectId)->get();
        }
        $this->periodid = PeriodDetail::where ('periodid' , $this->optionSelected)
                        ->where('cycleid' , $this->cycle->cycleid)
                        ->where('year' , $this->cycle->year)->first();
        $this->topicsteacher = TopciTeacher::where('teacherid' ,  session('id'))
                        ->where('perioddetailid' , $this->periodid->perioddetailid)
                        ->where('subjectid' , $this->subjectId)->orderBy('date' , 'asc')->get();
    }

    public function showTask() {
        $this->optionSelected;
        $this->click =  true;
        $this->periodid = PeriodDetail::where ('periodid' , $this->optionSelected)
                        ->where('cycleid' , $this->cycle->cycleid)
                        ->where('year' , $this->cycle->year)->first();
        $this->taskteacher = TaskTeacher::where('teacherid' ,  session('id'))
                        ->where('perioddetailid' , $this->periodid->perioddetailid)
                        ->where('subjectid' , $this->subjectId)->orderBy('date' , 'asc')->get();
    }

    public function showTopic() {
        $this->optionSelected;
        $this->click = false;
        $this->periodid = PeriodDetail::where ('periodid' , $this->optionSelected)
                        ->where('cycleid' , $this->cycle->cycleid)
                        ->where('year' , $this->cycle->year)->first();
        $this->topicsteacher = TopciTeacher::where('teacherid' ,  session('id'))
                        ->where('perioddetailid' , $this->periodid->perioddetailid)
                        ->where('subjectid' , $this->subjectId)->orderBy('date' , 'asc')->get();
    }
    //---------------------------------Codigo para agregar un tema por un determinado docente a x materia--------------------------------------
    public function updatedDate ($value){
        $changeDate = date('Y-m-d' , strtotime($value));
        $this->date = $changeDate;
    }

    public function addTopic() {

        $validationTopic = new ValidationTopic();

        $this->rules = $validationTopic::rules();
        $this->messages = $validationTopic::messages();

        $this->periodid = PeriodDetail::where ('periodid' , $this->optionSelected)
                        ->where('cycleid' , $this->cycle->cycleid)
                        ->where('year' , $this->cycle->year)->first();

        $this->validate();

        $datetopic = Carbon::parse($this->date);
        $since = Carbon::parse($this->periodid->since);
        $until = Carbon::parse($this->periodid->until);

        if ($datetopic->greaterThanOrEqualTo($since) && $datetopic->lessThanOrEqualTo($until)) {

            TopciTeacher::create([
                'teacherid' => session('id'),
                'topicid' => $this->topicselected,
                'perioddetailid' => $this->periodid->perioddetailid,
                'date' => $this->date,
                'subjectid' => $this->subjectId
            ]);
    
            return redirect()->route('subject.index' , ['subjectId' => $this->subjectId , 'cycleid' => $this->cycle->cycledetailid]);
        }
        else {
            session()->flash('messagedatetopic', 'la fecha elegida es invalida al rango de fehas');
        }
    }

    public function topicSelectedChanged(){
        $this->topicselected;
        $this->resetValidation('topicselected');
    }

    public function dateChanged(){
        $this->date;
        $this->resetValidation('date');
    }
    //---------------------Codigo para agregar activiadades o evaluaciones----------------------------------------------
    public function updatedDateTask ($value){
        $changeDateTask = date('Y-m-d' , strtotime($value));
        $this->datetask = $changeDateTask;
    }

    public function addTask(){

        $this->periodid = PeriodDetail::where ('periodid' , $this->optionSelected)
                        ->where('cycleid' , $this->cycle->cycleid)
                        ->where('year' , $this->cycle->year)->first();
        $percentageTotal = TaskTeacher::where('teacherid' ,  session('id'))
                        ->where('perioddetailid' , $this->periodid->perioddetailid)
                        ->where('subjectid' , $this->subjectId)->sum('percentage');

        if ($percentageTotal > 100 ){
            session()->flash('messagetask', 'El porcentaje total no debe ser mayor a el 100%. No se pueden agregar más tareas.');
        }
        else {

            $validationTask = new ValidationTasks;
            $this->rules = $validationTask::rules();
            $this->messages = ValidationTasks::messages(); 

            $this->validate();

            $datetask = Carbon::parse($this->datetask);
            $since = Carbon::parse($this->periodid->since);
            $until = Carbon::parse($this->periodid->until);

            if ($datetask->greaterThanOrEqualTo($since) && $datetask->lessThanOrEqualTo($until)) {

                TaskTeacher::create([
                    'tasktypeid' => $this->taskselected,
                    'objective' => $this->objective,
                    'description' => $this->description,
                    'perioddetailid' => $this->periodid->perioddetailid,
                    'percentage' => $this->percentage,
                    'status' => 2 ,
                    'date' => $this->datetask,
                    'teacherid' => session('id') ,
                    'subjectid' => $this->subjectId,
                ]);

                return redirect()->route('subject.index' , ['subjectId' => $this->subjectId , 'cycleid' => $this->cycle->cycledetailid]);
            }
            else {
                session()->flash('messagedate', 'la fecha elegida es invalida al rango de fehas');
            }

        }

    }

    public function taskSelectedChanged () {
        $this->taskselected;
        $this->resetValidation('taskselected');
    }
    public function percentageChanged() {
        $this->percentage;
        $this->resetValidation('percentage');
    }
    
    public function dateTaskChanged() {
        $this->datetask;
        $this->resetValidation('datetask');
    }

    //----------------------------------Codigo para Cambiar las Variables de los modales--------------------------------------//

    public function openModalTopic() {
        $this->periodid = PeriodDetail::where ('periodid' , $this->optionSelected)
                    ->where('cycleid' , $this->cycle->cycleid)
                    ->where('year' , $this->cycle->year)->first();
        $this->openTopic = true ;
    }

    public function openModalTask(){
        $this->periodid = PeriodDetail::where ('periodid' , $this->optionSelected)
                    ->where('cycleid' , $this->cycle->cycleid)
                    ->where('year' , $this->cycle->year)->first();
        $this->openTask = true ;
    }

    public function closeModals() {
        $this->openTopic = false;
        $this->openTask = false ;
        $this->resetValidation();
    }
    //---------------------------------------Metodos para cambiar el estado de un tema cuando el docente de click en el icono--------------------------------
    public function ChangeStatusTopic($id){
        $register = TopciTeacher::find($id);
        if ($register){
            if(Carbon::today()->lessThanOrEqualTo($register->date)) {
                $status = $register->status;
                if ($status == 2){
                    $register->status = 1 ;
                    $register->save();
                    $this->showTopic();
                }
                else {
                    if ($register->status == 1){             
                    $register->status = 2;
                    $register->save();
                    $this->showTopic();
                    }
                }

            }
            else {
                $register->status = 2;
                $register->save();
                $this->showTopic();
            }
        }
    }

    public function statusTopicChanged() {
        $this->statustopic;
    }

    //------------------------------------------Metodo para cambiar el estado de una activaidad cuando el docente de click en el icono----------------

    public function ChangeStatusTask($id) {

        $register = TaskTeacher::find($id);

        if ($register){
            $status = $register->status;
            if ($status == 2){
                $register->status = 1 ;
                $register->save();
                $this->showTask();
            }
            else {
                if ($register->status == 1){             
                $register->status = 2;
                $register->save();
                $this->showTask();
                }
            }
        }

    }

    //------------------------------------------Metodo para actualizar Informacion de un Tema por un docente-----------------------------------------//

    public function openUpdateTopic($topicid) {
        $this->isOpenTopic = true ;
        $this->periodid = PeriodDetail::where ('periodid' , $this->optionSelected)
                    ->where('cycleid' , $this->cycle->cycleid)
                    ->where('year' , $this->cycle->year)->first();
        
        $this->topictoupdate = TopciTeacher::find($topicid);
        $this->topicname = Topic::find($this->topictoupdate->topicid);
        $this->topicselected = $this->topicname->topicid;
        $this->date = $this->topictoupdate->date;
        $this->topicssubject = TopicSubject::where('subjectid' , $this->subjectId)
                                ->where('topicid' , '!=', $this->topicname->topicid)->get();
    }

    public function updateTopic(){
        $validationTopic = new ValidationTopic();
        $register = $this->topictoupdate;
        $this->rules = $validationTopic::rules();
        $this->messages = $validationTopic::messages();

        $this->periodid = PeriodDetail::where ('periodid' , $this->optionSelected)
                        ->where('cycleid' , $this->cycle->cycleid)
                        ->where('year' , $this->cycle->year)->first();

        $this->validate();

        $datetopic = Carbon::parse($this->date);
        $since = Carbon::parse($this->periodid->since);
        $until = Carbon::parse($this->periodid->until);

        if ($datetopic->greaterThanOrEqualTo($since) && $datetopic->lessThanOrEqualTo($until)) {

            $register->topicid = $this->topicselected;
            $register->date =  $this->date;
            $register->save();

    
            return redirect()->route('subject.index' , ['subjectId' => $this->subjectId , 'cycleid' => $this->cycle->cycledetailid]);
        }
        else {
            session()->flash('messagedatetopic', 'la fecha elegida es invalida al rango de fehas');
        }
    }

    public function closeModalTopic() {
        $this->isOpenTopic = false;
        $this->topicssubject = TopicSubject::where('subjectid' , $this->subjectId)->get();
    }

    //---------------------------------------Metodo para elminar un tema de la planificacion docente------------------------------------------------------------

    public function deleteTopicTeacher($topicid){

        $topictodelete = TopciTeacher::find($topicid) ;

        $topictodelete->delete();

    }

    //------------------------------------------------------Metodos para actualizar informacion de una actividad por un docente-----------------------------------

    public function openUpdateTask($taskid) {
        $this->isOpenTask = true ;
        $this->periodid = PeriodDetail::where ('periodid' , $this->optionSelected)
                    ->where('cycleid' , $this->cycle->cycleid)
                    ->where('year' , $this->cycle->year)->first();
        
        $this->tasktoupdate = TaskTeacher::find($taskid);
        $this->taskname = TaskType::find($this->tasktoupdate->tasktypeid);
        $this->taskselected = $this->taskname->tasktypeid;
        $this->datetask = $this->tasktoupdate->date;
        $this->tasks = TaskType::where('tasktypeid' , '!=', $this->taskname->tasktypeid)->get();
        $this->percentage =  $this->tasktoupdate->percentage;
        $this->objective = $this->tasktoupdate->objective;
        $this->description = $this->tasktoupdate->description;
        
    }

    public function updateTaskTeacher() {

        $this->periodid = PeriodDetail::where ('periodid' , $this->optionSelected)
                    ->where('cycleid' , $this->cycle->cycleid)
                    ->where('year' , $this->cycle->year)->first();
        $percentageTotal = TaskTeacher::where('teacherid' ,  session('id'))
                    ->where('perioddetailid' , $this->periodid->perioddetailid)
                    ->where('subjectid' , $this->subjectId)->sum('percentage');

        if ($percentageTotal > 100 ){
            session()->flash('messagetask', 'El porcentaje total no debe ser mayor a el 100%. No se pueden agregar más tareas.');
        }
        else {

            $validationTask = new ValidationTasks;
            $this->rules = $validationTask::rules();
            $this->messages = ValidationTasks::messages(); 
            $register = $this->tasktoupdate;

            $this->validate();

            $datetask = Carbon::parse($this->datetask);
            $since = Carbon::parse($this->periodid->since);
            $until = Carbon::parse($this->periodid->until);

            if ($datetask->greaterThanOrEqualTo($since) && $datetask->lessThanOrEqualTo($until)) {

                $register->tasktypeid = $this->taskselected;
                $register->objective = $this->objective;
                $register->description = $this->description;
                $register->percentage = $this->percentage;
                $register->date = $this->datetask;
                $register->save();

                $this->closeModalTaskTeacher();
            }
            else {
                session()->flash('messagedate', 'la fecha elegida es invalida al rango de fehas');
            }

        }
    }

    public function deleteTaskTeacher($id){
        $tasktodelete = TaskTeacher::find($id) ;
        $tasktodelete->delete();
        $this->showTask();
    }

    public function closeModalTaskTeacher() {
        $this->isOpenTask = false ;
        $this->showTask();
    }
}