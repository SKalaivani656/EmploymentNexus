<?php

namespace App\Models\Admin\Blog;

use App\Models\Admin\Blog\Categoryblog;
use App\Models\Admin\Blog\Tagblog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Postblog extends Model
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

    public function saveQuietly($arr = [])
    {
        return static::withoutEvents(function () {
            return $this->save();
        });
    }

    public function tagblog()
    {
        return $this->belongsToMany(Tagblog::class)->withTimestamps();
    }

    public function categoryblog()
    {
        return $this->belongsToMany(Categoryblog::class)->withTimestamps();
    }

    public function getTagblogSelectAttribute()
    {
        return $this->tagblog->pluck('id');
    }

    public function getCategoryblogSelectAttribute()
    {
        return $this->categoryblog->pluck('id');
    }
}
