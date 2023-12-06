<?php

namespace App\Http\Controllers;

use App\Models\Bibliography;
use App\Models\Careers;
use App\Models\CurriculumCareer;
use App\Models\CurriculumSubject;
use App\Models\CycleDetail;
use App\Models\Objective;
use App\Models\PeriodDetail;
use App\Models\Schedule;
use App\Models\Section;
use App\Models\Subject;
use App\Models\SubjectDetail;
use App\Models\TaskTeacher;
use App\Models\Teacher;
use App\Models\TopciTeacher;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\Style\Table;
use PhpOffice\PhpWord\ComplexType\TblWidth;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007\Style\Table as StyleTable;

class DownloadSyllabus extends Controller
{
    public function downloadSyllabus($cycleid , $subjectid){
        $schedule = "" ;
        $cont = 0;
        $suject = Subject::find($subjectid);
        $subjectdetail = SubjectDetail::where('subjectid' , $subjectid)->where('teacherid' , session('id'))->where('cycledetailid' , $cycleid)->first();
        $curriculumsubject = CurriculumSubject::where('subjectid' , $subjectid)->first();
        $curriculumcareer =  CurriculumCareer::where('curriculumcareerid' , $curriculumsubject->curriculumcareerid)->first();
        $prerequisite = Subject::find($curriculumsubject->prerequisiteid);
        $scheduleid = Schedule::find($subjectdetail->scheduleid);
        $scheduleidone = Schedule::find($subjectdetail->scheduleidone);
        $scheduleidtwo = Schedule::find($subjectdetail->scheduleidtwo);
        if ($scheduleidtwo === null) {
            $schedule = $scheduleid->day . ' de ' . $scheduleid->since . ' a ' . $scheduleid->until . ' y ' . 
                        $scheduleidone->day . ' de ' . $scheduleidone->since . ' a ' . $scheduleidone->until ;
        }else {
            $schedule = $scheduleid->day . ' de ' . $scheduleid->since . ' a ' . $scheduleid->until . ' y ' . 
                        $scheduleidone->day . ' de ' . $scheduleidone->since . ' a ' . $scheduleidone->until . ' y ' .
                        $scheduleidtwo->day . ' de ' . $scheduleidtwo->since . ' a ' . $scheduleidtwo->until;
        }
        $career = Careers::find($curriculumcareer->careerid);
        $classsection = Section::find($subjectdetail->sectionid);
        $teacher = Teacher::find(session('id'));
        $objectives = Objective::where('teacherid' , session('id'))->where('subjectid' , $subjectid)->where('cycledetailid' , $cycleid)->get();
        $cycledetail = CycleDetail::find($cycleid);
        $perioddetail = PeriodDetail::where('cycleid' , $cycledetail->cycleid)
                                        ->where('periodid' , 1)
                                        ->where('year' , $cycledetail->year)->first();
        $perioddetailtwo = PeriodDetail::where('cycleid' , $cycledetail->cycleid)
                                        ->where('periodid' , 2)
                                        ->where('year' , $cycledetail->year)->first();
        $perioddetailthree = PeriodDetail::where('cycleid' , $cycledetail->cycleid)
                                        ->where('periodid' , 3)
                                        ->where('year' , $cycledetail->year)->first();
        
        $topicsperiodone = TopciTeacher::where('teacherid' , session('id'))
                                ->where('perioddetailid' , $perioddetail->perioddetailid)
                                ->where('subjectid' , $subjectid)->orderBy('date' , 'asc')->get();
        $topicsperiodtwo = TopciTeacher::where('teacherid' , session('id'))
                                ->where('perioddetailid' , $perioddetailtwo->perioddetailid)
                                ->where('subjectid' , $subjectid)->orderBy('date' , 'asc')->get();
        $topicsperiodthree = TopciTeacher::where('teacherid' , session('id'))
                                ->where('perioddetailid' , $perioddetailthree->perioddetailid)
                                ->where('subjectid' , $subjectid)->orderBy('date' , 'asc')->get();
        $taskteacherperiodone = TaskTeacher::where('teacherid' , session('id'))
                                    ->where('subjectid' , $subjectid)
                                    ->where('perioddetailid' , $perioddetail->perioddetailid)->orderBy('date' , 'asc')->get();
        $taskteacherperiodtwo = TaskTeacher::where('teacherid' , session('id'))
                                    ->where('subjectid' , $subjectid)
                                    ->where('perioddetailid' , $perioddetailtwo->perioddetailid)->orderBy('date' , 'asc')->get();
        $taskteacherperiodthree = TaskTeacher::where('teacherid' , session('id'))
                                    ->where('subjectid' , $subjectid)
                                    ->where('perioddetailid' , $perioddetailthree->perioddetailid)->orderBy('date' , 'asc')->get();
        $bibliography = Bibliography::where('teacherid' , session('id'))->where('subjectid' , $subjectid)->where('cycledetailid' , $cycleid)->get();

        $syllabus = new PhpWord();
        $seciton = $syllabus->addSection();
        $stylefont = array(
            'name' => 'Courier New',
            'size' => 24,
            'bold' => true,
        );
        $stylefonttable = array(
            'name' => 'Courier New',
            'size' => 14 ,
        );
        $tablestyle = [
            'borderSize' => 6,
            'cellMargin' => 50,
        ];

        $cell = array('gridSpan' => 2, 'valign' => 'center');
        $celltask = array('gridSpan' => 3, 'valign' => 'center');

        $seciton->addText('Universidad Catolica de El Salvador.' , $stylefont);
        $seciton->addTextBreak();
        $seciton->addText('Facultad de Ingenieria y Arquitectura.' , $stylefont);
        $seciton->addTextBreak();
        $seciton->addText('Plan de Trabajo Docente.' , $stylefont);
        $seciton->addTextBreak();
        $seciton->addText('Ciclo y Año: ' . $cycledetail->cycleid . '/' . $cycledetail->year , $stylefont);
        $seciton->addTextBreak();
        $seciton->addText('I. Genearialidades.' , $stylefont);
        $syllabus->addTableStyle("tablestyle" , $tablestyle);
        $table = $seciton->addTable("tablestyle");
        $table->setWidth(100 * 50);
        $table->addRow();
        $table->addCell()->addText('Nombre del Docente: ' , $stylefonttable);
        $table->addCell()->addText(session('name') , $stylefonttable);
        $table->addRow();
        $table->addCell()->addText('Tipo de Contrato: ' , $stylefonttable);
        $table->addCell()->addText($teacher->contract , $stylefonttable);
        $table->addRow();
        $table->addCell()->addText('Asignatura y Seccion: ' , $stylefonttable);
        $table->addCell()->addText($suject->description . ' Seccion ' . $classsection->classsection , $stylefonttable);
        $table->addRow();
        $table->addCell()->addText('Carrera: ' , $stylefonttable);
        $table->addCell()->addText($career->description , $stylefonttable);
        $table->addRow();
        $table->addCell()->addText('Horario de Clases: ' , $stylefonttable);
        $table->addCell()->addText($schedule , $stylefonttable);
        $table->addRow();
        $table->addCell()->addText('Aula: ' , $stylefonttable);
        $table->addCell()->addText($subjectdetail->classroom , $stylefonttable);
        $table->addRow();
        $table->addCell()->addText('Materia de la que es prerequisito: ' , $stylefonttable);
        $table->addCell()->addText($prerequisite->description , $stylefonttable);
        $table->addRow();
        $table->addCell()->addText('Correo Electronico: ' , $stylefonttable);
        $table->addCell()->addText($teacher->email , $stylefonttable);
        $seciton->addTextBreak();
        $seciton->addText('II Objetivos' , $stylefont);
        foreach ($objectives as $objective){
            $description = (string) $objective->description;
            $seciton->addListItem($description, 0, $stylefonttable, ['listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_SQUARE_FILLED]);
        }

        $seciton->addText('III CALENDARIZACIÓN', $stylefont);
        $tableTopic = $seciton->addTable("tablestyle");
        $tableTopic->setWidth(100 * 50);
        $tableTopic->addRow();
        $tableTopic->addCell()->addText('Fecha' , $stylefonttable);
        $tableTopic->addCell()->addText('Tema' , $stylefonttable);
        $tableTopic->addRow();
        $tableTopic->addCell(9000, $cell)->addText('Primer Periodo' , $stylefonttable);

        foreach($topicsperiodone as $topic) {
            foreach($topic->topics as $topicname){
                $tableTopic->addRow();
                $tableTopic->addCell()->addText($topic->date, $stylefonttable);
                $tableTopic->addCell()->addText($topicname->name, $stylefonttable);
            }
        }

        $tableTopic->addRow();
        $tableTopic->addCell(9000 , $cell)->addText('Segundo Periodo' , $stylefonttable);

        foreach($topicsperiodtwo as $topic) {
            foreach($topic->topics as $topicname) {
                $tableTopic->addRow();
                $tableTopic->addCell()->addText($topic->date , $stylefonttable);
                $tableTopic->addCell()->addText($topicname->name , $stylefonttable) ;
            }
        }

        $tableTopic->addRow();
        $tableTopic->addCell(9000 , $cell)->addText('Tercer Periodo' , $stylefonttable);

        foreach($topicsperiodthree as $topic) {
            foreach($topic->topics as $topicname) {
                $tableTopic->addRow();
                $tableTopic->addCell()->addText($topic->date , $stylefonttable);
                $tableTopic->addCell()->addText($topicname->name , $stylefonttable) ;
            }
        }

        $seciton->addText('VI. EVALUACIONES' , $stylefont);
        $tableTask = $seciton->addTable('tablestyle');
        $tableTask->setWidth(100 * 50);
        $tableTask->addRow();
        $tableTask->addCell(9000 , $celltask)->addText('PRIMER PERIODO' , $stylefonttable);
        $tableTask->addRow();
        $tableTask->addCell()->addText('N' , $stylefonttable);
        $tableTask->addCell()->addText('Actividad' , $stylefonttable);
        $tableTask->addCell()->addText('Ponderación', $stylefonttable);

        foreach($taskteacherperiodone as $task){
            $cont ++;
            foreach($task->tasks as $taskname){
                $tableTask->addRow();
                $tableTask->addCell()->addText($cont , $stylefonttable);
                $tableTask->addCell()->addText($taskname->name , $stylefonttable);
                $tableTask->addCell()->addText($task->percentage . '%' , $stylefonttable);
            }
        }

        $tableTask->addRow();
        $tableTask->addCell(9000, $celltask)->addText('SEGUNDO PERIODO' , $stylefonttable);

        foreach($taskteacherperiodtwo as $task){
            $cont ++;
            foreach($task->tasks as $taskname){
                $tableTask->addRow();
                $tableTask->addCell()->addText($cont , $stylefonttable);
                $tableTask->addCell()->addText($taskname->name , $stylefonttable);
                $tableTask->addCell()->addText($task->percentage . '%' , $stylefonttable);
            }
        }

        $tableTask->addRow();
        $tableTask->addCell(9000, $celltask)->addText('TERCER PERIODO' , $stylefonttable);

        foreach($taskteacherperiodthree as $task){
            $cont ++;
            foreach($task->tasks as $taskname){
                $tableTask->addRow();
                $tableTask->addCell()->addText($cont , $stylefonttable);
                $tableTask->addCell()->addText($taskname->name , $stylefonttable);
                $tableTask->addCell()->addText($task->percentage . '%' , $stylefonttable);
            }
        }

        $seciton->addText('VII. BIBLIOGRAFIA' , $stylefont);
        foreach($bibliography as $book){
            foreach($book->books as $bookinfo){
                $bookiformation = $bookinfo->title . ' ' . $bookinfo->edition . ' Edición. Año de lanzamiento ' . $bookinfo->year;
                $seciton->addText('-' . $bookiformation , $stylefonttable);
                $seciton->addTextBreak();
            }
        }

        $archivo = public_path('Syllabus.docx');
        $syllabus->save($archivo);

        return response()->download($archivo)->deleteFileAfterSend(true);
    }
}
