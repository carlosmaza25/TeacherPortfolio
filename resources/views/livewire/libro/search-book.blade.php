<div>
    <div class="my-2 flex flex-col">
        <label class="my-3">{{'Docente: '. $name}}</label>
        <select name="" id="" class="border-2 w-64" wire:model="subjectselected" wire:input="subjectSelectedChanged">
            <option value="">Seleccione la materia:</option>
            @foreach ($subjects as $subject)
                @foreach ($subject->subjects as $item)
                    <option value="{{$item->subjectid}}">{{$item->description}}</option>
                @endforeach 
            @endforeach
        </select>
        @error('subjectselected')
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative my-2" role="alert">
            <strong class="font-bold">{{$message}}</strong>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
              <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" wire:click="closeModal"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
          </div>
        @enderror
    </div>
    <div class="py-3 flex flex-row">
        <label class="mx-3">Buscar:</label>
        <input type="text" placeholder="¿Qué libro desea encontrar?" class="border-2 border-black w-72" wire:model="searchbook" wire:input="searchBookChanged">
    </div>

   <h1 class="text-3xl text-blue-400 py-2">Libros:</h1>
   @if ($isOpen)
   <div class="flex flex-col w-3/6 bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3 my-2" role="alert">
        <div>         
            <p class="font-bold">Mensaje Informativo</p>
            <p class="text-lg my-2">{{$message}}</p>
        </div>
        <div class="flex justify-end">
            <button class="bg-blue-500 w-32 tex-center text-white h-9" wire:click="closeModal">Aceptar</button>
        </div>
        </div>
   @endif
   @if ($books->count())
   <table class="w-full">
    <thead>
        <tr>
            <th class="border border-blue-600 px-4 py-2 text-gray-800">Id</th>
            <th class="border border-blue-600 px-4 py-2 text-gray-800">Titulo</th>
            <th class="border border-blue-600 px-4 py-2 text-gray-800">Autor</th>
            <th class="border border-blue-600 px-4 py-2 text-gray-800">Edición</th>
            <th class="border border-blue-600 px-4 py-2 text-gray-800">Año</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($books as $book)
        <tr>
            <td class="border px-2 border-blue-200">{{$book->bookid}}</td>
            <td class="border px-2 border-blue-200">{{$book->title}}</td>
            <td class="border px-2 border-blue-200">{{$book->author}}</td>
            <td class="border px-2 border-blue-200">{{$book->edition}}</td>
            <td class="border px-2 border-blue-200">{{$book->year}}</td>
            <td>
                @php
                    $resultado = $this->existsBook($book->bookid)
                @endphp
                @if ($resultado)
                <button class="bg-green-500" wire:click="deleteOfBibliography({{$book->bookid}})"><i class="fas fa-trash" style="font-size: 32px"></i></button>
                @else
                <button class="bg-green-500" wire:click="addBibliography({{$book->bookid}})"><i class="fas fa-download" style="font-size: 32px"></i></button>
                @endif
            </td>
            <td></td>
        </tr>
        @endforeach
    </tbody>
    </table>
    @else
     <div class="px-6 py-4">No hay ningun registro que coincida</div>
    @endif
    <div class="px-6 py-3">
        {{$books->links()}}
    </div>
</div>
