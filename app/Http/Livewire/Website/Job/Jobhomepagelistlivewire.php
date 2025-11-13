<?php

namespace App\Http\Livewire\Website\Job;

use App\Models\Admin\Job\Jobpost\Postjob;
use Livewire\Component;
use Livewire\WithPagination;

class Jobhomepagelistlivewire extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $postjob_id, $classifyname, $classifytitle, $classifyid;

    public $searchtext = '';
    public $typefilter = [], $skillfilter = [], $categoryfilter = [], $coursefilter = [], $cityfilter = [], $companyfilter = [], $languagefilter = [];
    protected $listeners = ['parentsearch', 'parentfilter'];
    public $experiencyfilter, $salaryfilter;

    public function mount($postjob_id, $classifyname, $classifyid, $classifytitle)
    {
        $this->postjob_id = $postjob_id;
        $this->classifyname = $classifyname;
        $this->classifytitle = $classifytitle;
        $this->classifyid = $classifyid;

    }

    public function parentsearch($search)
    {
        $this->searchtext = $search;
        $this->resetPage();
    }

    public function parentfilter($filter, $value)
    {
        $this->$filter = $this->arrayfiltervalue($filter, $value);
    }

    private function arrayfiltervalue($filter, $value)
    {
        if ($filter == 'experiencyfilter' || $filter == 'salaryfilter') {
            $this->resetPage();
            return $value;
        } else {
            $filtered = array_filter(
                $value,
                fn($value, $key) => $value !== false,
                ARRAY_FILTER_USE_BOTH
            );
            $this->resetPage();
            return array_keys($filtered);
        }

    }

    public function render()
    {

        if ($this->postjob_id) {
            $query = Postjob::where('active', true)->where('id', '<>', $this->postjob_id);
        } else {
            if ($this->classifyname == 'all') {
                $query = Postjob::where('active', true);
            } else {
                switch ($this->classifyname) {
                    case "category":
                        $query = Postjob::where('active', true)->whereHas('categoryjob', fn($q) => $q->where('categoryjob_id', $this->classifyid));
                        break;
                    case "tag":
                        $query = Postjob::where('active', true)->whereHas('tagjob', fn($q) => $q->where('tagjob_id', $this->classifyid));
                        break;
                    case "designation":
                        $query = Postjob::where('active', true)->whereHas('designationjob', fn($q) => $q->where('designationjob_id', $this->classifyid));
                        break;
                    case "branch":
                        $query = Postjob::where('active', true)->whereHas('branchjob', fn($q) => $q->where('branchjob_id', $this->classifyid));
                        break;
                    case "course":
                        $query = Postjob::where('active', true)->whereHas('coursejob', fn($q) => $q->where('coursejob_id', $this->classifyid));
                        break;
                    case "company":
                        $query = Postjob::where('active', true)->where('companyjob_id', $this->classifyid);
                        break;
                    case "role":
                        $query = Postjob::where('active', true)->whereHas('rolejob', fn($q) => $q->where('rolejob_id', $this->classifyid));
                        break;
                    case "skill":
                        $query = Postjob::where('active', true)->whereHas('skilljob', fn($q) => $q->where('skilljob_id', $this->classifyid));
                        break;
                    case "language":
                        $query = Postjob::where('active', true)->whereHas('languagejob', fn($q) => $q->where('languagejob_id', $this->classifyid));
                        break;
                    case "type":
                        $query = Postjob::where('active', true)->whereHas('typejob', fn($q) => $q->where('typejob_id', $this->classifyid));
                        break;
                    case "competitiveexam":
                        $query = Postjob::where('active', true)->whereHas('competitiveexam', fn($q) => $q->where('competitiveexam_id', $this->classifyid));
                        break;
                    case "country":
                        $query = Postjob::where('active', true)->where('country_id', $this->classifyid);
                        break;
                    case "state":
                        $query = Postjob::where('active', true)->where('state_id', $this->classifyid);
                        break;
                    case "city":
                        $query = Postjob::where('active', true)->where('city_id', $this->classifyid);
                        break;
                    default:
                        $query = Postjob::where('active', true);
                }
            }
        }

        $this->searchtext && $query->where('title', 'like', '%' . $this->searchtext . '%');

        $this->typefilter && $query->whereHas('typejob', fn($querytype) =>
            $querytype->whereIn('typejob_id', $this->typefilter));

        $this->skillfilter && $query->whereHas('skilljob', fn($queryskill) =>
            $queryskill->whereIn('skilljob_id', $this->skillfilter));

        $this->categoryfilter && $query->whereHas('categoryjob', fn($querycategory) =>
            $querycategory->whereIn('categoryjob_id', $this->categoryfilter));

        $this->coursefilter && $query->whereHas('coursejob', fn($querycourse) =>
            $querycourse->whereIn('coursejob_id', $this->coursefilter));

        $this->cityfilter && $query->whereHas('cityjob', fn($querycity) =>
            $querycity->whereIn('cityjob_id', $this->cityfilter));

        $this->companyfilter && $query->whereIn('companyjob_id', $this->companyfilter);

        $this->languagefilter && $query->whereHas('languagejob', fn($querylanguage) =>
            $querylanguage->whereIn('languagejob_id', $this->languagefilter));

        $this->experiencyfilter && $query->where('min_exp', '<=', $this->experiencyfilter);

        $this->salaryfilter && $query->where('min_sal', '<=', $this->salaryfilter);

        return view('livewire.website.job.jobhomepagelistlivewire', [
            'postjob' => $query->latest()->paginate(25),
        ]);

    }
}
