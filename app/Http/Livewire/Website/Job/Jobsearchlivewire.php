<?php

namespace App\Http\Livewire\Website\Job;

use App\Models\Admin\Job\Jobpost\Postjob;
use Livewire\Component;

class Jobsearchlivewire extends Component
{

    public $query;
    public $joblist;

    public function mount()
    {
        $this->resetpage();
    }

    public function resetpage()
    {
        $this->query = '';
        $this->joblist = [];
    }

    public function updatedQuery()
    {

        $this->joblist = Postjob::where('title', 'like', '%' . $this->query . '%')
            ->get()
            ->toArray();

    }

    public function selectJob()
    {

        if ($this->query) {
            $this->redirect(route('jobindex'));
        }
    }

    public function render()
    {
        return view('livewire.website.job.jobsearchlivewire');
    }
}
