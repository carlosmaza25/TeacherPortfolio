<?php

namespace App\Livewire\Libro;

use App\Models\Bibliography;
use App\Models\Book;
use App\Models\CycleDetail;
use Livewire\Component;
use Livewire\WithPagination;
use App\Validation\ValidationBibliography;

class SearchBook extends Component
{

    use WithPagination;

    public $searchbook;
    public $name;
    public $subjects;
    public $subjectselected;
    public $rules;
    public $messages , $message;
    public $isOpen = false , $existsbook =  false;

    public function mount($name , $subjects) {
        $this->name = $name;
        $this->subjects = $subjects;
    }

    public function updatingSearchbook(){
        $this->resetPage();
    }

    public function render()
    {
        $books = Book::where('title' , 'ilike' ,  '%' . $this->searchbook . '%')->paginate(10);
        return view('livewire.libro.search-book' , compact('books'));
    }

    public function searchBookChanged(){
        $this->searchbook;
    }

    public function subjectSelectedChanged(){
        $this->subjectselected;
    }

    public function addBibliography($id){
        $cycle = CycleDetail::latest('cycledetailid')->first();
        $validation = new ValidationBibliography;
        $this->rules = $validation::rules();
        $this->messages = $validation::messages();
        $books = Book::find($id) ;

        $this->validate();
        Bibliography::create([
            'bookid' => $id,
            'teacherid' => session('id'),
            'subjectid' => $this->subjectselected,
            'cycledetailid' => $cycle->cycledetailid,
        ]);

        $this->message = 'se ha agregado el libro:' . $books->title . ' a la blibliografia';
        $this->isOpen = true;
    }

    public function closeModal(){
        $this->isOpen = false;
        $this->resetValidation();
    }

    public function existsBook($id) {
        $book = Book::find($id);
        $cycle = CycleDetail::latest('cycledetailid')->first();
        $bookteacher = Bibliography::where('teacherid' , session('id'))
                                    ->where('bookid' , $book->bookid)
                                    ->where('cycledetailid' , $cycle->cycledetailid)->get();
        if ($bookteacher->count()){
            return true ;
        }
        else {
            return false ;
        }
    }

    public function deleteOfBibliography ($id) {
        $cycle = CycleDetail::latest('cycledetailid')->first();
        $bibliographytodelete = Bibliography::where('teacherid' , session('id'))
                        ->where('bookid' , $id)
                        ->where('cycledetailid' , $cycle->cycledetailid)->get();
        $bibliographytodelete->each->delete();
    }
}
