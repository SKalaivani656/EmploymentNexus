<?php

namespace App\Models\Admin\Worldinfo;

use App\Models\Admin\Job\Jobpost\Postjob;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class City extends Model
{
    use HasFactory;

    public function postjob()
    {
        return $this->hasMany(Postjob::class);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public $appends = ['slug'];

    public function getSlugAttribute()
    {
        return Str::slug($this->name, '-');
    }
}
