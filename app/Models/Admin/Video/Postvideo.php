<?php

namespace App\Models\Admin\Video;

use App\Models\Admin\Video\Categoryvideo;
use App\Models\Admin\Video\Tagvideo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Postvideo extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i:s',
        'updated_at' => 'datetime:d-m-Y H:i:s',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function tagvideo()
    {
        return $this->belongsToMany(Tagvideo::class)->withTimestamps();
    }

    public function categoryvideo()
    {
        return $this->belongsToMany(Categoryvideo::class)->withTimestamps();
    }

    public function getTagvideoSelectAttribute()
    {
        return $this->tagvideo->pluck('id');
    }

    public function getCategoryvideoSelectAttribute()
    {
        return $this->categoryvideo->pluck('id');
    }

    public function saveQuietly($arr = [])
    {
        return static::withoutEvents(function () {
            return $this->save();
        });
    }
}
