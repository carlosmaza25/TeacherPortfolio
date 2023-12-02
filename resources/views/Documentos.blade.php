@extends($plantilla ? 'layouts.plantillaadmin' : 'layouts.plantillateacher')

@section('title' , 'Documentos')
    
@section('content')
    
    <div class="container"><h1 class="text-blue-400 text-2xl">Sección de Documentos Importantes.</h1>
        @if(session('success'))
        <div class="alert alert-success border-2 border-black bg-blue-500 text-black h-9 rounded-md">
            {{ session('success') }}
        </div>
        @endif
    
        @if ($errors->any())
        <div class="alert alert-danger bg-red-500 text-white rounded-lg h-9">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if ($plantilla)
            <form action="{{route('upload.file')}}" method="POST" enctype="multipart/form-data" class="flex end-0">
                @csrf
                <div class="flex flex-col">
                    <input type="file" , name="file" accept=".pdf , .doc , .docx" class="py-4">
                    <button type="submit" class="bg-green-500 text-white border-2 border-black rounded-lg">Subir Documentno</button>
                </div>
            </form>
        @endif

        <ul class="py-4">
            @foreach ($files as $file)
                <li>
                    <a class="text-blue-400 text-lg" href="{{ asset('uploads/' . basename($file)) }}" download>{{ basename($file) }}</a>
                </li>
            @endforeach
        </ul>
        
    </div>

@endsection
