@extends('layouts.plantillaadmin')

@section('title' , 'Home')
    
@section('content')

<div class="container overflow-x-auto my-6 border-2 bg-gray-200">
    @livewire('home-admin')
</div>

@endsection