<?php

namespace App\Http\Resources\Blog;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogdetailResource extends JsonResource
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
            'title' => $this->title ? $this->title : '',
            'subtitle' => $this->subtitle ? $this->subtitle : '',
            'location' => $location,

            'category' => $this->categoryblog ? $this->categoryblog->pluck('name')->implode(', ') : '',
            'tag' => $this->tagblog ? $this->tagblog->pluck('name')->implode(', ') : '',

            'body' => $this->body ? $this->body : '',
            'url' => '/blogdescription/' . $this->uuid,

            'posted_on' => $this->posted_on ? Carbon::parse($this->posted_on)->diffForHumans() : '',
        ];
    }
}
