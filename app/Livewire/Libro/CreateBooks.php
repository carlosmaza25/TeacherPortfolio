<?php

namespace App\Livewire\Libro;

use Livewire\Component;
use App\Models\Book;
use App\Validation\ValidationBook;

class CreateBooks extends Component
{

    public $search;
    public $isOpen = false;

    public $title , $author , $edition;
    public $year;
    public $rules , $messages;

    public function save() {

        $validationbook = new ValidationBook();
        $this->rules = $validationbook::rules();
        $this->messages = $validationbook::messages();

        $this->validate();

        Book::create([
            'title' => $this->title,
            'author' => $this->author,
            'edition' => $this->edition,
            'year' => $this->year
        ]);
    }

    public function render()
    {
        return view('livewire.libro.create-books');
    }

    
    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetValidation();
    }
}
