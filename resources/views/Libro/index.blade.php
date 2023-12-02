@extends($plantilla ? 'layouts.plantillaadmin' : 'layouts.plantillateacher')

@section('title' , 'Libros')

@section('content')

    <div class="container">

        <div class="my-3">
           @livewire('libro.create-books')
        </div>

        @livewire('libro.search-book' , ['name' => $name , 'subjects' => $subjects])

    </div>
@endsection