<div>
    <button class="mx-6 my-2 w-32 h-8 border-2 rounded-lg bg-green-400 text-white absolute bottom-6 right-0" wire:click="openModal()">Agregar</button>
    @if ($isOpen)
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="modal-overlay"></div>
        <div class="modal-container bg-white w-1/2 p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4 bg-gray-200">Agregar Objetivo</h2>
           <div class="mb-4">
               <label value=>Objetivo:</label>
               <textarea type="text" placeholder="digite el objetivo" class="w-full border-2 border-black rounded-md" wire:model.defer="description"></textarea>

            <button wire:click="closeModal" class="bg-red-500 text-white px-4 py-2 rounded">Cerrar Modal</button>
            <button class="bg-green-500 text-white px-4 py-2 rounded" wire:click="save">Agregar</button>
        </div>
    </div>
</div>
    @endif
</div>
