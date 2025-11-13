<?php

namespace App\Http\Livewire\Website\Job;

use App\Models\Admin\Job\Jobmaster\Categoryjob;
use App\Models\Admin\Job\Jobmaster\Companyjob;
use App\Models\Admin\Job\Jobmaster\Coursejob;
use App\Models\Admin\Job\Jobmaster\Languagejob;
use App\Models\Admin\Job\Jobmaster\Skilljob;
use App\Models\Admin\Job\Jobmaster\Typejob;
use App\Models\Admin\Worldinfo\City;
use App\Models\Admin\Worldinfo\State;
use Livewire\Component;

class Jobhomefilterlivewire extends Component
{

    public $typejob, $skilljob, $categoryjob, $coursejob, $cityjob, $companyjob, $languagejob;
    public $jobtypefilterid = [], $jobskillfilterid = [], $jobcategoryfilterid = [], $jobcoursefilterid = [], $jobcityfilterid = [], $jobtopcompanyfilterid = [], $joblanguagefilterid = [];
    public $menuactiveflag;
    public $experiencefilter, $salaryfilter;

    public function mount()
    {
        $this->menuactiveflag = ''; // Default type
        $this->typejob = Typejob::where('active', true)->get();
        $this->skilljob = Skilljob::where('active', true)->get();
        $this->categoryjob = Categoryjob::where('active', true)->get();
        $this->coursejob = Coursejob::where('active', true)->get();
        $state_id = State::where('country_id', 101)->pluck('id');
        $this->cityjob = City::whereIn('state_id', [0])->get();
        $this->companyjob = Companyjob::where('active', true)->take(15)->get();
        $this->languagejob = Languagejob::where('active', true)->get();

    }

    public function filtermenuclick($menuactive)
    {
        switch ($menuactive) {
            case "type":
                ($this->menuactiveflag == "type") ? ($this->menuactiveflag = 'default') : ($this->menuactiveflag = 'type');
                break;
            case "skill":
                ($this->menuactiveflag == "skill") ? ($this->menuactiveflag = 'default') : ($this->menuactiveflag = 'skill');
                break;
            case "category":
                ($this->menuactiveflag == "category") ? ($this->menuactiveflag = 'default') : ($this->menuactiveflag = 'category');
                break;
            case "course":
                ($this->menuactiveflag == "course") ? ($this->menuactiveflag = 'default') : ($this->menuactiveflag = 'course');
                break;
            case "city":
                ($this->menuactiveflag == "city") ? ($this->menuactiveflag = 'default') : ($this->menuactiveflag = 'city');
                break;
            case "company":
                ($this->menuactiveflag == "company") ? ($this->menuactiveflag = 'default') : ($this->menuactiveflag = 'company');
                break;
            case "language":
                ($this->menuactiveflag == "language") ? ($this->menuactiveflag = 'default') : ($this->menuactiveflag = 'language');
                break;
            case "experience":
                ($this->menuactiveflag == "experience") ? ($this->menuactiveflag = 'default') : ($this->menuactiveflag = 'experience');
                break;
            case "salary":
                ($this->menuactiveflag == "salary") ? ($this->menuactiveflag = 'default') : ($this->menuactiveflag = 'salary');
                break;
            default:
                $this->menuactiveflag = "type";
        }

    }

    public function jobexperiencyfilter()
    {
        $this->emit('parentfilter', 'experiencyfilter', $this->experiencefilter);
    }

    public function jobsalaryfilter()
    {
        $this->emit('parentfilter', 'salaryfilter', $this->salaryfilter);
    }

    public function updatedJobtypefilterid()
    {
        $this->emit('parentfilter', 'typefilter', $this->jobtypefilterid);
    }

    public function updatedJobskillfilterid()
    {
        $this->emit('parentfilter', 'skillfilter', $this->jobskillfilterid);
    }

    public function updatedJobcategoryfilterid()
    {
        $this->emit('parentfilter', 'categoryfilter', $this->jobcategoryfilterid);
    }

    public function updatedJobcoursefilterid()
    {
        $this->emit('parentfilter', 'coursefilter', $this->jobcoursefilterid);
    }

    public function updatedJobcityfilterid()
    {
        $this->emit('parentfilter', 'cityfilter', $this->jobcityfilterid);
    }

    public function updatedJobtopcompanyfilterid()
    {
        $this->emit('parentfilter', 'companyfilter', $this->jobtopcompanyfilterid);
    }

    public function updatedJoblanguagefilterid()
    {
        $this->emit('parentfilter', 'languagefilter', $this->joblanguagefilterid);
    }

    public function render()
    {
        return view('livewire.website.job.jobhomefilterlivewire');
    }
}
