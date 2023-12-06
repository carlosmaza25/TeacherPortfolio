<div>
    <button class="bg-green-400 h-10 w-52 rounded-lg" wire:click="openModal">Inscribir Materias</button>
    @if ($isOpen)
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="modal-overlay"></div>
        <div class="modal-container bg-white w-1/2 p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4 bg-gray-200">Inscribir Materias</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div class="mb-4">
                    <label>Mateias:</label>
                    <select name="subject" id="subject" class="mx-2 px-2 border-2 border-black rounded-md w-72" wire:model="subjectid" wire:input="subjectidChanged">
                        <option value="">Seleccione la materia</option>
                        @foreach ($subjects as $subject)
                            <option value="{{$subject->description}}">{{$subject->description}}</option>
                        @endforeach
                    </select>
                    @error('subjectid')
                        <span class="text-red-500">{{$message}}</span>
                    @enderror
                 </div>
                 <div class="mb-4">
                    <label>Horario:</label>
                    <select name="shedule" id="shedule" class="mx-2 px-2 border-2 border-black rounded-md w-72" wire:model="scheduleid" wire:input="scheduleidChanged">
                        <option value="">Seleccione el Horario</option>
                        @foreach ($schedules as $schedule)
                            <option value="{{$schedule->day . '-' . $schedule->since . '-' . $schedule->until}}">{{$schedule->day . '-' . $schedule->since . '-' . $schedule->until}}</option>
                        @endforeach
                    </select>
                    @error('scheduleid')
                        <span class="text-red-500">{{$message}}</span>
                    @enderror
                    <select name="sheduleone" id="sheduleone" class="mx-16 my-2 px-2 border-2 border-black rounded-md w-72" wire:model="scheduleidone" wire:input="scheduleidOneChanged">
                        <option value="" class="px-32">Seleccione el Horario</option>
                        @foreach ($schedules as $schedule)
                            <option value="{{ $schedule->id }}" class="px-32">{{$schedule->day . '-' . $schedule->since . '-' . $schedule->until}}</option>
                        @endforeach
                    </select>
                    @error('scheduleidone')
                        <span class="text-red-500">{{$message}}</span>
                    @enderror
                    <select name="sheduletwo" id="sheduletwo" class="mx-16 px-2 border-2 border-black rounded-md w-72" wire:model="scheduleidtwo" wire:input="scheduleidTwoChanged">
                        <option value="" class="px-32">Seleccione el Horario</option>
                        @foreach ($schedules as $schedule)
                            <option value="{{ $schedule->id }}" class="px-32">{{$schedule->day . '-' . $schedule->since . '-' . $schedule->until}}</option>
                        @endforeach
                    </select>
                    <div class="text-red-500 mx-20">El tercer Horario no es requerido</div>
                    @error('scheduleidtwo')
                        <span class="text-red-500">{{$message}}</span>
                    @enderror
                 </div>
                 <div class="mb-4">
                    <label>Sección:</label>
                    <select name="section" id="section" class="mx-2 px-2 border-2 border-black rounded-md w-72" wire:model="sectionid" wire:input="sectionidChanged">
                        <option value="">Seleccione la Sección</option>
                        @foreach ($sections as $section)
                            <option value="{{$section->classsection}}">{{$section->classsection}}</option>
                        @endforeach
                    </select>
                    @error('sectionid')
                        <span class="text-red-500">{{$message}}</span>
                    @enderror
                 </div>

                 <div class="mb-4">
                    <label>Aula:</label>
                    <input type="text" id="classroom" class="w-32 border-2 border-black rounded-md mx-8" wire:model="classroom" wire:input="classroomChanged">
                    @error('classroom')
                        <span class="text-red-500">{{$message}}</span>
                    @enderror
                 </div>

            </div>

            <button wire:click="closeModal" class="bg-red-500 text-white px-4 py-2 rounded">Cerrar Modal</button>
            <button class="bg-green-500 text-white px-4 py-2 rounded" wire:click="save()">Agregar</button>
        </div>
    </div>
    @endif
</div>
