@extends('layouts.plantillaadmin')

@section('title' , 'Materias')
    
@section('content')
    <div class="container overflow-x-auto my-6 border-2 bg-gray-200">
        @livewire('all-subjects')
    </div>
@endsection