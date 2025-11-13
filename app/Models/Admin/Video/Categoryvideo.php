<?php

namespace App\Models\Admin\Video;

use App\Models\Admin\Video\Postvideo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Categoryvideo extends Model
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

    public function postvideo()
    {
        return $this->belongsToMany(Postvideo::class);
    }

    public function saveQuietly($arr = [])
    {
        return static::withoutEvents(function () {
            return $this->save();
        });
    }
}
