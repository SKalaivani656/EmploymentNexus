<?php

namespace App\Http\Livewire\Website\Job;

use Livewire\Component;

class Jobhomesearchlivewire extends Component
{

    public $search = '';

    public function updatedSearch()
    {
        $this->emit('parentsearch', $this->search);
    }

    public function render()
    {
        return view('livewire.website.job.jobhomesearchlivewire');
    }
}
