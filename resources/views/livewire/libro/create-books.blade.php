<div>
    <button class="bg-green-400 h-10 w-52 rounded-lg" wire:click="openModal">Agregar Nuevo Libro</button>
    @if ($isOpen)
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="modal-overlay"></div>
        <div class="modal-container bg-white w-1/2 p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4 bg-gray-200">Agregar Libro</h2>
           <div class="mb-4">
               <label value=>Titulo:</label>
               <input type="text" class="w-full border-2 border-black rounded-md" wire:model.defer="title">
              @error('title')
                <span class="text-red-500">{{$message}}</span>
              @enderror
           </div>

           <div class="mb-4">
               <label>Autor:</label>
               <input type="text" class="w-full border-2 border-black rounded-md" wire:model.defer="author">
               @error('author')
                <span class="text-red-500">{{$message}}</span>
               @enderror
           </div>

           <div class="mb-4">
            <label>Edición:</label>
            <input type="text" class="w-full border-2 border-black rounded-md" wire:model.defer="edition">
            @error('edition')
                <span class="text-red-500">{{$message}}</span>
            @enderror
            </div>

            <div class="mb-4">
                <label>Año de Lanzamiento:</label>
                <input type="text" class="w-full border-2 border-black rounded-md" wire:model.defer="year">
                @error('year')
                    <span class="text-red-500">{{$message}}</span>
                @enderror
            </div>

            <button wire:click="closeModal" class="bg-red-500 text-white px-4 py-2 rounded">Cerrar Modal</button>
            <button class="bg-green-500 text-white px-4 py-2 rounded" wire:click="save">Agregar</button>
        </div>
    </div>
    @endif

</div>
