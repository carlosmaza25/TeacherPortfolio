<div>
    <div class="flex flex-row my-2">
        <label for="" class="my-2">Buscar:</label>
        <input type="text" class="w-full border-2 border-black mx-2 rounded-md" wire:model="searchsubjects" wire:input="searchSubjectChanged">
        <button class="bg-green-500 text-white border-2 rounded-lg h-10 w-52" wire:click="openModal">Agregar Materia</button>
    </div>
    <table class="w-full text-md text-left text-gray-500 dark:text-gray-400 my-1">
        <thead class="text-xs text-blue-500 uppercase bg-blue-500 dark:bg-blue-200 dark:text-blue-700">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nombre
                </th>
                <th scope="col" class="px-6 py-3">
                    Abreviatura
                </th>
                <th scope="col" class="px-6 py-3">
                    Unidades Valorativas
                </th>
                <th scope="col" class="px-6 py-3">
                    Horas
                </th>
                <th scope="col" class="px-6 py-3">
                    
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $curriculumsubject)
            @foreach ($curriculumsubject->subjects as $subject)
            <tr class="bg-white border-b dark:bg-blue-300 dark:border-blue-500">
                <th scope="row" class="px-6 py-4 font-medium text-black">
                    {{$subject->description}}
                </th>
                <td class="px-6 py-4 text-black">
                    {{$subject->nickname}}
                </td>
                <td class="px-6 py-4 text-black">
                    {{$curriculumsubject->valueunit}}
                </td>
                <td class="px-6 py-4 text-black">
                    {{$curriculumsubject->hours}}
                </td>
                <td>
                    <i class="fas fa-edit cursor-pointer px-4 fa-lg" style="color: black" wire:click="openUpdateSubject({{$curriculumsubject->curriculumsubjectid}})"></i>
                    <i class="fas fa-trash cursor-pointer px-4 fa-lg" style="color: black"></i>
                </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
    {{$subjects->links()}}

    @if ($openmodal)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div class="modal-overlay"></div>
            <div class="modal-container bg-white w-1/2 p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold mb-4 bg-gray-200">Agregar Nueva Materia</h2>
               <div class="mb-4">
                   <label value=>Nombre:</label>
                   <input type="text" class="w-full border-2 border-black rounded-md" wire:model="name">
                  @error('name')
                    <span class="text-red-500">{{$message}}</span>
                  @enderror
               </div>
    
               <div class="mb-4">
                   <label>Abreviatura:</label>
                   <input type="text" class="w-full border-2 border-black rounded-md" wire:model="nickname">
                   @error('nickname')
                    <span class="text-red-500">{{$message}}</span>
                   @enderror
               </div>
    
               <div class="mb-4">
                <label>Carrera:</label>
                <select name="" id=""  class="border-2 border-black rounded-lg" wire:model="career">
                    <option value="Seleccione una Opcion">Seleccione una Opcion</option>
                    @foreach ($careers as $career)
                        <option value="{{$career->careerid}}">{{$career->description}}</option>
                    @endforeach
                </select>
                @error('career')
                    <span class="text-red-500">{{$message}}</span>
                @enderror
                </div>
    
                <div class="mb-4">
                    <label>Unidades Valorativas:</label>
                    <input type="number" class="w-full border-2 border-black rounded-md" wire:model="valueunit">
                    @error('valueunit')
                        <span class="text-red-500">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Pre-requisito:</label>
                        <select name="" id="" class="border-2 border-black rounded-lg" wire:model="prerequisite">
                            <option value="Seleccione una Opcion">Seleccione una Opcion</option>
                        @foreach ($subjects1 as $subject)
                            <option value="{{$subject->subjectid}}">{{$subject->description}}</option>
                        @endforeach
                        </select>
                    @error('prerequisite')
                        <span class="text-red-500">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Materia que abre:</label>
                    <select name="" id="" class="border-2 border-black rounded-lg" wire:model="opento">
                        <option value="Seleccione una Opcion">Seleccione una Opcion</option>
                    @foreach ($subjects1 as $subject)
                        <option value="{{$subject->subjectid}}">{{$subject->description}}</option>
                    @endforeach
                    </select>
                    @error('opento')
                        <span class="text-red-500">{{$message}}</span>
                    @enderror
                    @if (isset($messages) && is_string($messages))
                        <span class="text-red-500">{{$messages}}</span>
                    @endif
                </div>

                <div class="mb-4">
                    <label>Horas:</label>
                        <input type="number" class="w-full border-2 border-black rounded-md" wire:model="hours">
                    @error('hours')
                        <span class="text-red-500">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Numero de ciclo:</label>
                    <input type="number" class="w-full border-2 border-black rounded-md" wire:model="cyclenumber">
                    @error('cyclenumber')
                        <span class="text-red-500">{{$message}}</span>
                    @enderror
                </div>
    
                <button wire:click="closeModal" class="bg-red-500 text-white px-4 py-2 rounded">Cerrar Modal</button>
                <button class="bg-green-500 text-white px-4 py-2 rounded" wire:click="save">Agregar</button>
            </div>
        </div>
        @endif

        @if ($openupdatesubject)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div class="modal-overlay"></div>
            <div class="modal-container bg-white w-1/2 p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold mb-4 bg-gray-200">Agregar Nueva Materia</h2>
               <div class="mb-4">
                   <label value=>Nombre:</label>
                   <input type="text" class="w-full border-2 border-black rounded-md" wire:model="name">
                  @error('name')
                    <span class="text-red-500">{{$message}}</span>
                  @enderror
               </div>
    
               <div class="mb-4">
                   <label>Abreviatura:</label>
                   <input type="text" class="w-full border-2 border-black rounded-md" wire:model="nickname">
                   @error('nickname')
                    <span class="text-red-500">{{$message}}</span>
                   @enderror
               </div>
    
               <div class="mb-4">
                <label>Carrera:</label>
                <select name="" id=""  class="border-2 border-black rounded-lg" wire:model="career">
                    <option value="{{$career}}">{{$careerdescription->description}}</option>
                    @foreach ($careers as $career)
                        <option value="{{$career->careerid}}">{{$career->description}}</option>
                    @endforeach
                </select>
                @error('career')
                    <span class="text-red-500">{{$message}}</span>
                @enderror
                </div>
    
                <div class="mb-4">
                    <label>Unidades Valorativas:</label>
                    <input type="number" class="w-full border-2 border-black rounded-md" wire:model="valueunit">
                    @error('valueunit')
                        <span class="text-red-500">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Pre-requisito:</label>
                        <select name="" id="" class="border-2 border-black rounded-lg" wire:model="prerequisite">
                            <option value="{{$prerequisite}}">{{$prerequisitedescription->description}}</option>
                        @foreach ($subjects1 as $subject)
                            <option value="{{$subject->subjectid}}">{{$subject->description}}</option>
                        @endforeach
                        </select>
                    @error('prerequisite')
                        <span class="text-red-500">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Materia que abre:</label>
                    <select name="" id="" class="border-2 border-black rounded-lg" wire:model="opento">
                        <option value="{{$opento}}">{{$opentodescription->description}}</option>
                    @foreach ($subjects1 as $subject)
                        <option value="{{$subject->subjectid}}">{{$subject->description}}</option>
                    @endforeach
                    </select>
                    @error('opento')
                        <span class="text-red-500">{{$message}}</span>
                    @enderror
                    @if (isset($messages) && is_string($messages))
                        <span class="text-red-500">{{$messages}}</span>
                    @endif
                </div>

                <div class="mb-4">
                    <label>Horas:</label>
                        <input type="number" class="w-full border-2 border-black rounded-md" wire:model="hours">
                    @error('hours')
                        <span class="text-red-500">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Numero de ciclo:</label>
                    <input type="number" class="w-full border-2 border-black rounded-md" wire:model="cyclenumber">
                    @error('cyclenumber')
                        <span class="text-red-500">{{$message}}</span>
                    @enderror
                </div>
    
                <button wire:click="closeModalUpdate" class="bg-red-500 text-white px-4 py-2 rounded">Cerrar</button>
                <button class="bg-green-500 text-white px-4 py-2 rounded" wire:click="updateSubject">Modificar</button>
            </div>
        </div>
        @endif

</div>
