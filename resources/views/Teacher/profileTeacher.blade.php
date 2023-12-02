@extends($plantilla ? 'layouts.plantillaadmin' : 'layouts.plantillateacher')

@section('title' , 'perfil')
    
@section('content')

    <div class="container flex flex-row py-10">
        <div class="flex flex-col justify-center items-center w-64 h-64 border-2 border-black p-2 bg-blue-200">
            <img src="{{$socialProfile->socialavatar}}" alt="" class="rounded-full w-40 h-40">
            <h1>{{$datesuser->name . ' ' . $datesuser->lastname}}</h1>
            <h1>Ingenieria y Arquitectura</h1>
        </div>
        <div class="w-full h-72 border-2 mx-6 bg-gray-300">
            <form action="{{ route('teacher.update') }}" method="POST">
                @csrf
            <div class="flex justify-end">
                <button class="bg-green-500 bottom-2 text-white w-32 h-8 mx-4 my-2" type="submit">Guardar</button>
            </div>
            <div class="flex flex-col mx-5">
                <label for="">Residencia:</label>
                <textarea name="home" id="home" cols="1" rows="3" class="w-3/4"></textarea>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-row mx-5 my-3">
                    <label for="">Nombres:</label>
                    <input type="text" name="names" id="names" class="w-52 h-6 border-2 border-black mx-2" placeholder="{{ $datesuser->name }}">
                    @if (session('namevalidation'))
                        <div class="text-red-500">{{ session('namevalidation') }}</div>
                    @endif
                </div>
                <div class="flex flex-row mx-5 my-3">
                    <label for="">Apellidos:</label>
                    <input type="text" name="lastnames" id="lastnames" class="w-52 h-6 border-2 border-black mx-2" placeholder="{{ $datesuser->lastname }}">
                    @if (session('lastname'))
                        <div class="text-red-500">{{ session('lastname') }}</div>
                    @endif
                </div>
                <div class="flex flex-row mx-5 my-3">
                    <label for="">DUI:</label>
                    <input type="text" name="id" id="id" class="w-52 h-6 border-2 border-black mx-12" placeholder="No aplica">
                </div>
                <div class="flex flex-row mx-5 my-3">
                    <span>
                        <i class="fas fa-phone"></i>
                    </span>
                    <input type="text" name="phone" id="phone" class="w-52 h-6 border-2 border-black mx-14" id="cellphone" placeholder="{{$datesuser->cellphonenumber}}">
                    @if (session('cellphone'))
                        <div class="text-red-500">{{ session('cellphone') }}</div>
                    @endif
                </div>
                <div class="flex flex-row mx-5 my-3">
                    <label for="">ID:</label>
                    <input type="text" name="universityid" id="universityid" class="w-52 h-6 border-2 border-black mx-14" placeholder="{{$datesuser->universityid}}">
                </div>
                <div class="flex flex-row mx-5 my-3">
                    <span>
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="text" name="email" id="email" class="w-52 h-6 border-2 border-black mx-14" placeholder="{{$datesuser->email}}">
                </div>
            </div>
            </form>
                @livewire('subject-profile' , ['id' => $datesuser->teacherid])
        </div>
    </div>
    
@endsection