<div>
    <div class="grid grid-cols-4">
        <div>
            <div class="flex flex-row">
                <div class="mx-4">
                    <select name="" id="period" wire:model="optionSelected" wire:input="optionSelectedChanged"class="border-2 rounded-lg">
                        <option value="1">Seleccione el periodo</option>
                        @foreach ($period as $period)
                            <option value="{{$period->periodid}}">{{' Periodo ' . $period->period}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div>
            <div>
                <span class="text-sm font-semibold cursor-pointer">Mensajes</span>
                <button wire:click=""><i class="fas fa-envelope text-blue-500 text-xl mr-2 cursor-pointer"></i></button>
            </div>
        </div>
        <div>
            <div>
                <span class="text-sm font-semibold cursor-pointer {{$click ? 'text-black' : 'text-red-500 font-bold'}}" wire:click="showTopic()">Listado de temas</span>
                <button wire:click="openModalTopic"><i class="fas fa-edit text-blue-500 text-xl mr-2 cursor-pointer"></i></button>
            </div>
        </div>
        <div>
            <div>
                <span class="text-sm font-semibold cursor-pointer {{$click ?  'text-red-500 font-bold' : 'text-black'}}" wire:click="showTask()">Listado de evaluaciones</span>
                <button wire:click="openModalTask"><i class="fas fa-edit text-blue-500 text-xl mr-2 cursor-pointer"></i></button>
            </div>
        </div>
        <div class="flex flex-col col-span-2 my-4">
            @if ($click)
            @foreach ($taskteacher as $task)
            @foreach ($task->tasks as $tasksubject)
                <div class="flex items-center">
                    <div class="w-full">
                        <i class=" text-blue-500 text-xl mr-2 cursor-pointer
                        @if($currentdate > $task->date)
                            fas fa-times
                        @elseif($task->status == 2)
                            fas fa-edit
                        @else
                            fas fa-check
                        @endif
                        " wire:click="ChangeStatusTask({{$task->taskteacherid}})"></i>
                        <span class="text-sm font-semibold">{{$tasksubject->name . ' (' . $task->percentage . '%)'}}</span>
                    </div>
                    <div class="w-full">
                        <button class="bg-green-500 text-white px-4 py-2 rounded mx-2 my-2" wire:click="openUpdateTask({{$task->taskteacherid}})">Modificar</button>
                        <button wire:click="deleteTaskTeacher({{$task->taskteacherid}})" class="bg-red-500 text-white px-4 py-2 my-2 rounded">Eliminar</button>
                    </div>
                </div>
            @endforeach
            @endforeach
            @else
            @foreach ($topicsteacher as $topic)
                @foreach ($topic->topics as $topicsubject)
                    <div class="flex items-center">
                        <div class="w-full">
                            <i class="text-blue-500 text-xl mr-2 cursor-pointer 
                            @if($currentdate > $topic->date)
                                fas fa-times
                            @elseif($topic->status == 2)
                                fas fa-edit
                            @else
                                fas fa-check
                            @endif
                            " wire:click="ChangeStatusTopic('{{$topic->topicteacherid}}')"  wire:model="statustopic" wire:input="statusTopicChanged"></i>
                            <span class="text-sm font-semibold mx-4">{{$topicsubject->name}}</span>
                        </div>
                        <div class="w-full">
                            <button class="bg-green-500 text-white px-4 py-2 rounded mx-2 my-2" wire:click="openUpdateTopic({{$topic->topicteacherid}})">Modificar</button>
                            <button wire:click="deleteTopicTeacher({{$topic->topicteacherid}})" class="bg-red-500 text-white px-4 py-2 my-2 rounded">Eliminar</button>
                        </div>
                    </div>
                 @endforeach
            @endforeach
         @endif
        </div>
        <div class="flex flex-col my-4">
            @if ($click)
                @foreach ($taskteacher as $item)
                    <label for="" class="my-4">{{'Periodo ' . $optionSelected}}</label>
                 @endforeach
            @else
                 @foreach ($topicsteacher as $item)
                    <label for="" class="my-4">{{'Periodo ' . $optionSelected}}</label>
                @endforeach
            @endif
        </div>
        <div class="flex flex-col my-4">
            @if ($click)
            @foreach ($taskteacher as $item)
                <label for="" class="my-4">{{$item->date}}</label>
             @endforeach
        @else
             @foreach ($topicsteacher as $item)
                <label for="" class="my-4">{{$item->date}}</label>
            @endforeach
        @endif
        </div>
    </div>

    @if ($openTopic)
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="modal-overlay"></div>
            <div class="modal-container bg-white w-1/2 p-6 rounded-lg shadow-lg">
             <h2 class="text-xl font-semibold mb-4 bg-gray-200">Agregar Temas</h2>
            <div class="mb-4">
               <label value=>Temas:</label>
             <select name="topic" id="topic" class="border-2 rounded-lg" wire:model="topicselected" wire:input="topicSelectedChanged">
                <option value="">Seleccione el tema</option>
                @foreach ($topicssubject as $topic)
                    @foreach ($topic->topics as $topicsubject)
                        <option value="{{$topicsubject->topicid}}">{{$topicsubject->name}}</option>
                    @endforeach
                @endforeach
            </select>
            @error('topicselected')
                <span>{{$message}}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="">Fecha:</label>
            <input type="date" class="border-2" wire:model="date" wire:input="dateChanged">
            @if (session('messagedatetopic'))
                <span class="text-red-500">{{session('messagedatetopic')}}</span>
            @endif
            @error('date')
                <span>{{$message}}</span>
            @enderror
            <label for="" class="font-bold">{{'el rango de fehcas a elegir es: desde ' . $periodid->since . ' hasta ' . $periodid->until}}</label>
        </div>
        <button wire:click="closeModals" class="bg-red-500 text-white px-4 py-2 rounded">Cerrar Modal</button>
        <button class="bg-green-500 text-white px-4 py-2 rounded" wire:click="addTopic">Agregar</button>
        </div>
    </div>
    @endif



    @if ($openTask)
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="modal-overlay"></div>
        <div class="modal-container bg-white w-1/2 p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4 bg-gray-200">Agregar Evaluaciones</h2>
           <div class="mb-4">
               <label value=>Evaluaciones:</label>
               <select name="task" id="task" class="border-2 rounded-lg" wire:model="taskselected" wire:input="taskSelectedChanged">
                <option value="">Seleccion Una Evaluación</option>
                @foreach ($tasks as $task)
                    <option value="{{$task->tasktypeid}}">{{$task->name}}</option>
                @endforeach
               </select>
               @error('taskselected')
                   <span class="text-red-500">{{$message}}</span>
               @enderror
        </div>
        <div class="flex items-center mb-4">
            <label for="" class="px-2">Objetivo:</label>
            <textarea name="" id="" cols="100" rows="3" class="border-2 mx-5" wire:model="objective"></textarea>
        </div>
        <div class="flex items-center mb-4">
            <label for="" class="px-2">Descripción:</label>
            <textarea name="" id="" cols="100" rows="3" class="border-2" wire:model="description"></textarea>
        </div>
        <div class="mb-4">
            <label for="">Porcentaje:</label>
            <input type="number" min="1" max="50" class="border-2 mx-5" wire:model="percentage" wire:input="percentageChanged">
            @if (session('messagetask'))
                <span class="text-red-500">{{session('messagetask')}}</span>
            @endif
            @error('percentage')
                 <span class="text-red-500">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="">Fecha:</label>
            <input type="date" class="border-2 mx-14" wire:model="datetask" wire:input="dateTaskChanged">
            @error('datetask')
                <span class="text-red-500">{{$message}}</span>
            @enderror
            @if (session('messagedate'))
                <span class="text-red-500">{{session('messagedate')}}</span>
            @endif
            <label for="" class="font-bold">rango de fechas a elegir: </label>
            <label for="" class="font-bold">{{'desde ' . $periodid->since . ' hasta ' . $periodid->until}}</label>
        </div>
        <button wire:click="closeModals" class="bg-red-500 text-white px-4 py-2 rounded">Cerrar Modal</button>
        <button class="bg-green-500 text-white px-4 py-2 rounded" wire:click="addTask">Agregar</button>
    </div>
    </div>
    @endif


    @if ($isOpenTopic)
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="modal-overlay"></div>
            <div class="modal-container bg-white w-1/2 p-6 rounded-lg shadow-lg">
             <h2 class="text-xl font-semibold mb-4 bg-gray-200">Agregar Temas</h2>
            <div class="mb-4">
               <label value=>Temas:</label>
             <select name="topic" id="topic" class="border-2 rounded-lg" wire:model="topicselected" wire:input="topicSelectedChanged">
                <option value="{{$topicname->topicid}}">{{$topicname->name}}</option>
                @foreach ($topicssubject as $topic)
                    @foreach ($topic->topics as $topicsubject)
                        <option value="{{$topicsubject->topicid}}">{{$topicsubject->name}}</option>
                    @endforeach
                @endforeach
            </select>
            @error('topicselected')
                <span>{{$message}}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="">Fecha:</label>
            <input type="date" class="border-2" wire:model="date" wire:input="dateChanged">
            @if (session('messagedatetopic'))
                <span class="text-red-500">{{session('messagedatetopic')}}</span>
            @endif
            @error('date')
                <span>{{$message}}</span>
            @enderror
            <label for="" class="font-bold">{{'el rango de fehcas a elegir es: desde ' . $periodid->since . ' hasta ' . $periodid->until}}</label>
        </div>
        <button wire:click="closeModalTopic" class="bg-red-500 text-white px-4 py-2 rounded">Cancelar</button>
        <button class="bg-green-500 text-white px-4 py-2 rounded" wire:click="updateTopic">Actualizar</button>
        </div>
    </div>
    @endif


    @if ($isOpenTask)
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="modal-overlay"></div>
        <div class="modal-container bg-white w-1/2 p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4 bg-gray-200">Agregar Evaluaciones</h2>
           <div class="mb-4">
               <label value=>Evaluaciones:</label>
               <select name="task" id="task" class="border-2 rounded-lg" wire:model="taskselected" wire:input="taskSelectedChanged">
                <option value="{{$taskname->tasktypeid}}">{{$taskname->name}}</option>
                @foreach ($tasks as $task)
                    <option value="{{$task->tasktypeid}}">{{$task->name}}</option>
                @endforeach
               </select>
               @error('taskselected')
                   <span class="text-red-500">{{$message}}</span>
               @enderror
        </div>
        <div class="flex items-center mb-4">
            <label for="" class="px-2">Objetivo:</label>
            <textarea name="" id="" cols="100" rows="3" class="border-2 mx-5" wire:model="objective"></textarea>
        </div>
        <div class="flex items-center mb-4">
            <label for="" class="px-2">Descripción:</label>
            <textarea name="" id="" cols="100" rows="3" class="border-2" wire:model="description"></textarea>
        </div>
        <div class="mb-4">
            <label for="">Porcentaje:</label>
            <input type="number" min="1" max="50" class="border-2 mx-5" wire:model="percentage" wire:input="percentageChanged">
            @if (session('messagetask'))
                <span class="text-red-500">{{session('messagetask')}}</span>
            @endif
            @error('percentage')
                 <span class="text-red-500">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="">Fecha:</label>
            <input type="date" class="border-2 mx-14" wire:model="datetask" wire:input="dateTaskChanged">
            @error('datetask')
                <span class="text-red-500">{{$message}}</span>
            @enderror
            @if (session('messagedate'))
                <span class="text-red-500">{{session('messagedate')}}</span>
            @endif
            <label for="" class="font-bold">rango de fechas a elegir: </label>
            <label for="" class="font-bold">{{'desde ' . $periodid->since . ' hasta ' . $periodid->until}}</label>
        </div>
        <button wire:click="closeModalTaskTeacher" class="bg-red-500 text-white px-4 py-2 rounded">Cerrar Modal</button>
        <button class="bg-green-500 text-white px-4 py-2 rounded" wire:click="updateTaskTeacher">Modificar</button>
    </div>
    </div>
    @endif

</div>
