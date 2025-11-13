<?php

namespace App\Models\Admin\Job\Jobmaster;

use App\Models\Admin\Job\Jobpost\Postjob;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Categoryjob extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public $appends = ['is_default'];

    public function getIsDefaultAttribute()
    {
        return false;
    }

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

    public function postjob()
    {
        return $this->belongsToMany(Postjob::class)
            ->withTimestamps();
    }
}
