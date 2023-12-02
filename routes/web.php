<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\CycleController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AllSubjectsController;
use App\Http\Controllers\DownloadSyllabus;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UploadFile;
use App\Models\CycleDetail;
use PhpOffice\PhpWord\Element\Row;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('login');

Route::get('/google-auth/redirect', [LoginController::class , 'redirectToProvider'])->name('google.redirect');
Route::get('/google-auth/callback', [LoginController::class , 'handleProviderCallback'])->name('google.callback');

Route::middleware(['auth'])->group(function() {
    Route::get('home/{cycleid?}', [HomeController::class , 'index'])->name('home.index');

});
Route::get('Libro', [LibroController::class , 'index'])->name('libro.index');
Route::get('Materias/{cycleid}', [AdminController::class , 'index'])->name('subject.admin');
Route::get('Perfil/{id}', [TeacherController::class , 'index'])->name('teacher.index');
Route::post('Update' , [TeacherController::class , 'update'])->name('teacher.update');
Route::get('Ciclo', [CycleController::class , 'Cycle'])->name('admin.cycle');
Route::post('Save', [CycleController::class , 'save'])->name('save.cycle');
Route::get('Generalidades/{subjectId?}/{cycleid?}', [SubjectController::class , 'index'])->name('subject.index');
Route::get('Materias' , [AllSubjectsController::class , 'index'])->name('allsubject.index');
Route::get('Descargar Syllabus/{cycleid}/{subjectid}' , [DownloadSyllabus::class , 'downloadSyllabus'])->name('download.syllabus');
Route::get('Documentos' , [UploadFile::class , 'documents'])->name('file');
Route::post('Upload' , [UploadFile::class , 'upload'])->name('upload.file');