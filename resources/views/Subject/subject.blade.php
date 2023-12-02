@extends($plantilla ? 'layouts.plantillaadmin' : 'layouts.plantillateacher')

@section('title' , 'Materia')

@section('content')

<div class="container my-4">
    <div class="grid grid-cols-2">
        <div class="flex flex-col mx-4"> 
            <h1 class="text-3xl font-bold">Generalidades</h1>
            <div class="border-2 w-72 h-10 my-6"><h1 class="py-2 px-2">{{$subject->description}}</h1></div>
            <div class="flex flex-col my-2 h-60 w-full border-2 px-4 py-4">

                <div class="flex flex-row">
                    <label for="" class="px-4">Ciclo:</label>
                    <label for="">{{$informationcycle}}</label>
                </div>

                <div class="flex flex-row my-4">
                    <label for="" class="px-4">Aula:</label>
                    <label for="">{{$subjectdetail->classroom}}</label>
                </div>

                <div class="flex flex-row">
                    <label for="" class="px-4">Horario:</label>
                    <label for="">{{$schedule->day . ' ' . $schedule->since . ' ' . $schedule->until}}</label>
                </div>

                <div class="flex flex-row my-4">
                    <label for="" class="px-4">Horas:</label>
                    <label for="">{{$schedule->day . ' ' . $schedule->since . ' ' . $schedule->until}}</label>
                </div>

            </div>
        </div>
        <div class="flex flex-col">
            <h1 class="text-3xl font-bold">Objetivos</h1>
            <div class="relative">
                <div class="border-2 h-80 w-full my-6 px-6">
                    @foreach ($objectivesteacher as $objectiveteacher)
                            <ul class="list-disc text-lg">
                                <li>{{$objectiveteacher->description}}</li>
                            </ul>
                    @endforeach
                    @livewire('create-objective' , ['subjectid' => $subjectId , 'cycle' => $cycle])
                </div>
            </div>
        </div>
    </div>
    <form  method="GET" action=" {{ route('download.syllabus' , ['cycleid' => $cycle->cycledetailid , 'subjectid' => $subject->subjectid]) }} ">
        <button type="submit" class="w-40 h-8 rounded-lg bg-red-500 text-white my-2">Descargar Syllabus</button>
    </form>
    @livewire('show-topic', ['periods' => $periods , 'topicsteacher' => $topicsteacher , 'cycle' => $cycle , 'subjectId' => $subjectId])
</div>
    
@endsection