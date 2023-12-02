<div>
        <div class="flex flex-row my-2">
            <label for="" class="my-2">Buscar:</label>
            <input type="text" class="w-full border-2 border-black mx-2 rounded-md" wire:model="searchteacher" wire:input="searchTeacherChanged">
            <button class="bg-green-500 text-white border-2 rounded-lg h-10 w-52" wire:click="openModal">Agregar Docente</button>
        </div>
        <table class="w-full text-md text-left text-gray-500 dark:text-gray-400 my-1">
            <thead class="text-xs text-blue-500 uppercase bg-blue-500 dark:bg-blue-200 dark:text-blue-700">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Carnet
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tipo de contrato
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $teacher)
                <tr class="bg-white border-b dark:bg-blue-300 dark:border-blue-500">
                    <th scope="row" class="px-6 py-4 font-medium text-black">
                        <a href="{{route('teacher.index' , ['id' => $teacher->teacherid])}}">{{$teacher->name . ' ' . $teacher->lastname}}</a>
                    </th>
                    <td class="px-6 py-4 text-black">
                        {{$teacher->email}}
                    </td>
                    <td class="px-6 py-4 text-black">
                        {{$teacher->universityid}}
                    </td>
                    <td class="px-6 py-4 text-black">
                        {{$teacher->contract}}
                    </td>
                    <td><i class="fas fa-trash cursor-pointer" style="color: black" wire:click="deleteTeacher({{ $teacher->teacherid }})"></i></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{$teachers->links()}}

        @if ($openmodal)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div class="modal-overlay"></div>
            <div class="modal-container bg-white w-1/2 p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold mb-4 bg-gray-200">Agregar Docente</h2>
            <div class="mb-4">
                <label value=>Nombres:</label>
                <input type="text" class="w-full border-2 border-black rounded-md" wire:model="name">
                @error('name')
                    <span class="text-red-500">{{$message}}</span>
                @enderror
            </div>
    
            <div class="mb-4">
                <label>Apellidos:</label>
                <input type="text" class="w-full border-2 border-black rounded-md" wire:model="lastname">
                @error('lastname')
                    <span class="text-red-500">{{$message}}</span>
                @enderror
            </div>
    
            <div class="mb-4">
                <label>Carnet:</label>
                <input type="text" class="w-full border-2 border-black rounded-md" wire:model="universityid">
                @error('universityid')
                    <span class="text-red-500">{{$message}}</span>
                @enderror
                </div>
    
                <div class="mb-4">
                    <label>Email:</label>
                    <input type="text" class="w-full border-2 border-black rounded-md" wire:model="email">
                    @error('email')
                        <span class="text-red-500">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Celular:</label>
                    <input type="text" class="w-full border-2 border-black rounded-md" wire:model="cellphonenumber" wire:input="cellphoneNumberChanged">
                    @error('cellphonenumber')
                        <span class="text-red-500">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Tipo de Contraro:</label>
                    <select name="" id="" class="border-2 border-black rounded-lg" wire:model="contract" wire:input="contractChanged()">
                        <option value="Seleccione una Opcion">Seleccione una Opcion</option>
                        <option value="Tiempo Completo">Tiempo Completo</option>
                        <option value="Por Hora">Por Hora</option>
                    </select>
                    @error('contract')
                        <span class="text-red-500">{{$message}}</span>
                    @enderror
                    @if (isset($messages) && is_string($messages))
                        <span class="text-red-500">{{$messages}}</span>
                    @endif
                </div>

                <div class="mb-4">
                    <label>Tipo de Usuario:</label>
                    <select name="" id="" class="border-2 border-black rounded-lg" wire:model="userid">
                        <option value="Seleccione una Opcion">Seleccione una Opcion</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Docente">Docente</option>
                    </select>
                    @error('userid')
                        <span class="text-red-500">{{$message}}</span>
                    @enderror
                </div>
    
                <button wire:click="closeModal" class="bg-red-500 text-white px-4 py-2 rounded">Cerrar Modal</button>
                <button class="bg-green-500 text-white px-4 py-2 rounded" wire:click="save">Agregar</button>
            </div>
        </div>
        @endif
</div>
