<div>
    
<div class="relative overflow-x-auto my-6">
    <table class="w-full text-md text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-blue-500 uppercase bg-blue-500 dark:bg-blue-200 dark:text-blue-700">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Materia
                </th>
                <th scope="col" class="px-6 py-3">
                    Horario
                </th>
                <th scope="col" class="px-6 py-3">
                    Aula
                </th>
                <th scope="col" class="px-6 py-3">
                    Seccion
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $subject)
            @foreach ($subject->subjects as $item)
            @foreach ($subject->schedules as $schedule)
            @foreach ($subject->sections as $section)
            <tr class="bg-white border-b dark:bg-blue-300 dark:border-blue-500">
                <th scope="row" class="px-6 py-4 font-medium text-white">
                        {{$item->description}}
                        <br>
                        <div class="w-64 h-6 bg-gray-200 border border-gray-400 rounded-lg">
                            <div class="h-6 bg-green-500 text-black text-center text-sm leading-6"
                                style="width:  {{$totaltopics = $this->Advance($item->subjectid) . '%'}}">
                                {{$totaltopics = $this->Advance($item->subjectid) . '%'}}
                            </div>
                        </div>
                </th>
                <td class="px-6 py-4 text-white">
                    {{$schedule->day . ' de ' . $schedule->since . ' a ' . $schedule->until }}
                </td>
                <td class="px-6 py-4 text-white">
                    {{$subject->classroom}}
                </td>
                <td class="px-6 py-4 text-white">
                    {{$section->classsection}}
                </td>
            </tr>
            @endforeach
            @endforeach
            @endforeach
            @endforeach
        </tbody>
    </table>
</div>

</div>
