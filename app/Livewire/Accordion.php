<?php

namespace App\Livewire;

use Livewire\Component;

class Accordion extends Component
{
    public $open = ''; // id accordion yang terbuka

    public function toggle($id)
    {
        $this->open = ($this->open === $id) ? '' : $id;
    }

    public function render()
    {
        return view('livewire.accordion', [
            'items' => [
                ['id' => 1, 'title' => 'Accordion 1', 'content' => 'Isi konten 1'],
                ['id' => 2, 'title' => 'Accordion 2', 'content' => 'Isi konten 2'],
                ['id' => 3, 'title' => 'Accordion 3', 'content' => 'Isi konten 3'],
            ]
        ]);
    }
}
