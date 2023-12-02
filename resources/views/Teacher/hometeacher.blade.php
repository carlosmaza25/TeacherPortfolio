@extends('layouts.plantillateacher')

@section('title' , 'Home')
    
@section('content')

    <div class="container py-8">
        <div>
            @livewire('create-subjects')
        </div>
        <div class="flex justify-end">
                <select name="cicle" id="cicleSelect" class="border-2 rounded-xl text-blue-400">
                    <option value="{{$lastcycle->cycledetailid}}" data-default="{{ $lastcycle->cycleid }}">{{'Ciclo ' . $lastcycle->cycleid . ' ' . $lastcycle->year}}</option>
                    @foreach ($cycledetail as $cycle)
                        <option value="{{  $cycle->cycledetailid }}">{{'Ciclo ' . $cycle->cycleid . ' ' . $cycle->year}}</option>
                    @endforeach
                </select>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 border-3 p-2">
            <div class="col-span-1 lg:col-span-2"><h1 class="text-3xl text-blue-400">Listado de Materias</h1></div>
            @foreach ($subjects as $subject)
                @foreach ($subject->subjects as $item)
                <a href="{{ route('subject.index', ['subjectId' => $item->subjectid , 'cycleid' => $cycles->cycledetailid])}}" id="subjectToHome" class="block bg-white h-60 text-center rounded-md border-2 cursor-pointer">
                    <div class="flex flex-col">
                        <div class="h-32 bg-gray-500"></div>
                        <div class="text-left text-gray-600 my-2 text-lg">{{$cycleinfo}}</div>
                        <div class="text-left">
                            <span class="hover:underline">{{$item->description}}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            @endforeach
        </div>
        </div>        

        <script>
            // Al cargar la página
            document.addEventListener("DOMContentLoaded", function() {
                // Recuperar el valor seleccionado almacenado en LocalStorage
                var selectedCicleId = localStorage.getItem("selectedCicleId");
                var select = document.getElementById('cicleSelect');
                
                // Establecer el valor seleccionado en el select
                if (selectedCicleId) {
                    document.getElementById('cicleSelect').value = selectedCicleId;
                }
            });
        
            // Cuando se cambia la selección en el select
                document.getElementById('cicleSelect').onchange = function() {
                var selectedCicleId = this.value;
        
                // Guardar el valor seleccionado en LocalStorage
                localStorage.setItem("selectedCicleId", selectedCicleId);
        
                // Redirigir a la página deseada
                window.location.href = '/home/' + selectedCicleId;
            };

        document.addEventListener("loadFromOtherPage", function() {
            localStorage.removeItem("selectedCicleId");
            var select = document.getElementById('cicleSelect');
            var defaultOption = select.querySelector("option[data-default]");
            select.value = defaultOption.getAttribute("data-default");
    });

        document.addEventListener("Clear", function() {
            localStorage.removeItem("selectedCicleId");
    });

    document.getElementById('subjectToHome').addEventListener('click', function(event) {
        event.preventDefault();
        var event = new Event('loadFromOtherPage');
        document.dispatchEvent(event);
        window.location.href = this.href;
    });
        </script>

@endsection