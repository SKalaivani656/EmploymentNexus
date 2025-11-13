<?php

namespace App\Http\Resources\Video;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       
        return [
            'uuid' => $this->uuid ? $this->uuid : '',
            'videoid' => $this->uniqid ? $this->uniqid : '',
            'title' => $this->title ? $this->title : '',
            'link' => $this->link ? $this->link : '',
            'imagelink' => $this->img_link ? $this->img_link : '',
            'category' => $this->categoryvideo ? $this->categoryvideo->pluck('name')->implode(', ') : '',
            'tag' => $this->tagvideo ? $this->tagvideo->pluck('name')->implode(', ') : '',
            'body' => $this->body ? $this->body : '',
            'posted_on' => $this->posted_on ? Carbon::parse($this->posted_on)->diffForHumans() : '',
        ];
    }
}
