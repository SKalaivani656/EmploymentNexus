<?php

namespace App\Http\Resources\Job;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $location = '';
        $this->country && $location = $this->country;
        $this->state && $location .= ',' . $this->state;
        $this->city && $location .= ',' . $this->city;

        return [
            'uuid' => $this->uuid ? $this->uuid : '',
            'jobid' => $this->jobid ? $this->jobid : $this->uniqid,
            'title' => $this->title ? $this->title : '',
            // 'subtitle' => $this->subtitle ? $this->subtitle : '',
            'experience' => ($this->min_exp && $this->max_exp) ? $this->min_exp . '-' . $this->max_exp : (($this->min_exp) ? $this->min_exp : ''),
            'salary' => ($this->min_sal && $this->max_sal) ? $this->min_sal . '-' . $this->max_sal : (($this->min_sal) ? $this->min_sal : ''),
            'location' => $location,
            'image' => $this->companyjob ? '/storage/images/companyjob/images/' . $this->companyjob->image : '',
            'company' => $this->companyjob ? $this->companyjob->name : '',
            'education' => $this->coursejob ? $this->coursejob->pluck('name')->implode(', ') : '',
            'type' => $this->typejob ? $this->typejob->pluck('name')->implode(', ') : '',
            'posted_on' => $this->posted_on ? Carbon::parse($this->posted_on)->diffForHumans() : '',
        ];
    }
}
