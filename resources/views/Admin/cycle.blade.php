@extends('layouts.plantillaadmin')

@section('title' , 'Ciclos')
    
@section('content')

    <div class="container py-12">
        @if (session('cycleexists'))
            <div class="my-4 text-blue-400 text-2xl border-2 border-black rounded-lg">{{session('cycleexists')}}</div>
        @endif
        <form method="POST" action="{{route('save.cycle')}}">
            @csrf
        <div class="border-2 p-4 rounded-md">
            <div class="flex justify-between">

                <div class="flex flex-cols">
                    <h1 class="mx-2">Ciclo:</h1>
                    <select name="cycle" id="" class="w-32 border-2 rounded-md">
                        <option value="1">Uno</option>
                        <option value="2">Dos</option>
                    </select>
                </div>
    
                <div class="flex flex-cols">
                    <h1 class="mx-2">Inicio:</h1>
                    <input type="date" name="start" class="w-52 h-7 border-2 border-black rounded-md">
                    @if (session('sincecycle'))
                        <div class="text-red-500 mx-2">{{session('sincecycle')}}</div>
                    @endif
                </div>
    
                <div class="flex flex-cols">
                    <h1 class="mx-2">Fin:</h1>
                    <input type="date" name="end" class="w-52 h-7 border-2 border-black rounded-md">
                    @if (session('untilcycle'))
                        <div class="text-red-500 mx-2">{{session('untilcycle')}}</div>
                    @endif
                </div>
    
            </div>
    
                <div class="flex justify-between my-4">
    
                    <div class="flex items-start flex-cols">
                        <h1 class="mx-14">Periodo 1:</h1>
                    </div>
        
                    <div class="flex flex-cols">
                        <h1 class="mx-2">Inicio:</h1>
                        <input type="date" name="startperiodone" class="w-52 h-7 border-2 border-black rounded-md">
                        @if (session('sinceperiodone'))
                            <div class="text-red-500 mx-2">{{session('sinceperiodone')}}</div>
                        @endif
                    </div>
        
                    <div class="flex flex-cols">
                        <h1 class="mx-2">Fin:</h1>
                        <input type="date" name="endperiodone" class="w-52 h-7 border-2 border-black rounded-md">
                        @if (session('untilperiodone'))
                            <div class="text-red-500 mx-2">{{session('untilperiodone')}}</div>
                        @endif
                    </div>
                </div>

                <div class="flex justify-between my-4">
    
                    <div class="flex items-start flex-cols">
                        <h1 class="mx-14">Periodo 2:</h1>
                    </div>
        
                    <div class="flex flex-cols">
                        <h1 class="mx-2">Inicio:</h1>
                        <input type="date" name="startperiodtwo" class="w-52 h-7 border-2 border-black rounded-md">
                        @if (session('sinceperiodtwo'))
                            <div class="text-red-500 mx-2">{{session('sinceperiodtwo')}}</div>
                        @endif
                    </div>
        
                    <div class="flex flex-cols">
                        <h1 class="mx-2">Fin:</h1>
                        <input type="date" name="endperiodtwo" class="w-52 h-7 border-2 border-black rounded-md">
                        @if (session('untilperiodtwo'))
                            <div class="text-red-500 mx-2">{{session('untilperiodtwo')}}</div>
                        @endif
                    </div>
                </div>

                <div class="flex justify-between my-4">
    
                    <div class="flex items-start flex-cols">
                        <h1 class="mx-14">Periodo 3:</h1>
                    </div>
        
                    <div class="flex flex-cols">
                        <h1 class="mx-2">Inicio:</h1>
                        <input type="date" name="startperiodthree" class="w-52 h-7 border-2 border-black rounded-md">
                        @if (session('sinceperiodthree'))
                            <div class="text-red-500 mx-2">{{session('sinceperiodthree')}}</div>
                        @endif
                    </div>
        
                    <div class="flex flex-cols">
                        <h1 class="mx-2">Fin:</h1>
                        <input type="date" name="endperiodthree" class="w-52 h-7 border-2 border-black rounded-md">
                        @if (session('untilperiodthree'))
                            <div class="text-red-500 mx-2">{{session('untilperiodthree')}}</div>
                        @endif
                    </div>
                </div>

            <div class="flex justify-end">
                <button type="submit" class="mx-6 w-32 h-8 border-2 rounded-lg bg-green-400 text-white">Agregar</button>
                <button class="w-32 h-8 border-2 rounded-lg bg-black text-white">Cancelar</button>
            </div>
        </form>
        </div>

        <h1 class="text-blue-600 text-xl my-3">Últimos Ciclos:</h1>

            <table class="w-full text-md text-left text-gray-500 dark:text-gray-400 my-1">
                <thead class="text-xs text-blue-500 uppercase bg-blue-500 dark:bg-blue-200 dark:text-blue-700">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Ciclo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Periodo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha de Inicio
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha de Finalizacion
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Año
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Periodsdetail as $perioddetail)
                    <tr class="bg-white border-b dark:bg-blue-300 dark:border-blue-500">
                        <th scope="row" class="px-6 py-4 font-medium text-black">
                            {{$perioddetail->cycleid}}
                        </th>
                        <td class="px-6 py-4 text-black">
                            {{$perioddetail->periodid}}
                        </td>
                        <td class="px-6 py-4 text-black">
                            {{$perioddetail->since}}
                        </td>
                        <td class="px-6 py-4 text-black">
                            {{$perioddetail->until}}
                        </td>
                        <td class="px-6 py-4 text-black">
                            {{$perioddetail->year}}
                        </td>
                        <td>
                            @livewire('edit-cycle', ['id' => $perioddetail->perioddetailid])
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var editModal = document.getElementById('editModal');
        
                // Verifica si la URL contiene información de edición
                if (window.location.href.indexOf('edit') !== -1) {
                    // Abre el modal automáticamente
                    editModal.style.display = 'block';
                }
        
                // ... el resto del script para cerrar el modal ...
            });
        </script>
        

@endsection