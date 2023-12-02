<div>
    <i class="fas fa-edit cursor-pointer" style="color: black" wire:click="openModal"></i>

    @if ($isOpen)
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="modal-overlay"></div>
        <div class="modal-container bg-white w-1/2 p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4 bg-gray-200">Modificar El periodo</h2>

            <div class="flex justify-between mb-4">
                <label for="" class="mx-2">{{'Periodo ' . $periodtoedit->periodid . ':'}}</label>
                <div>
                    <label for="">Inicio:</label>
                    <input type="date" class="border-black border-2 rounded-lg" wire:model="since">
                </div>
                <div>
                    <label for="">Fin:</label>
                    <input type="date" class="border-black border-2 rounded-lg" wire:model="until">
                </div>
            </div>

            <button wire:click="closeModal" class="bg-red-500 text-white px-4 py-2 rounded">Cancelar</button>
            <button class="bg-green-500 text-white px-4 py-2 rounded" wire:click="updatePeriod">Modificar</button>

        </div>
    @endif
</div>
