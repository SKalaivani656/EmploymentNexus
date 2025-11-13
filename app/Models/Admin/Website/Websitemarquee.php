<?php

namespace App\Models\Admin\Website;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Websitemarquee extends Model
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

    public static function getWebsiteMarquee()
    {
        $marquee = Websitemarquee::where('active', '=', 1)->first();
        if ($marquee) {
            return $marquee->marquee;
        } else {
            return false;
        }
    }
}
