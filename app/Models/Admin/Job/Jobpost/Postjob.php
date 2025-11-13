<?php

namespace App\Models\Admin\Job\Jobpost;

use App\Models\Admin\Exam\Master\Competitiveexam;
use App\Models\Admin\Job\Jobmaster\Branchjob;
use App\Models\Admin\Job\Jobmaster\Categoryjob;
use App\Models\Admin\Job\Jobmaster\Companyjob;
use App\Models\Admin\Job\Jobmaster\Coursejob;
use App\Models\Admin\Job\Jobmaster\Designationjob;
use App\Models\Admin\Job\Jobmaster\Languagejob;
use App\Models\Admin\Job\Jobmaster\Notificationlinkjob;
use App\Models\Admin\Job\Jobmaster\Rolejob;
use App\Models\Admin\Job\Jobmaster\Skilljob;
use App\Models\Admin\Job\Jobmaster\Tagjob;
use App\Models\Admin\Job\Jobmaster\Typejob;
use App\Models\Admin\Worldinfo\City;
use App\Models\Admin\Worldinfo\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Postjob extends Model
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

    public function branchjob()
    {
        return $this->belongsToMany(Branchjob::class)
        // ->using(BranchjobPostjob::class)
            ->withTimestamps();
    }
    public function categoryjob()
    {
        return $this->belongsToMany(Categoryjob::class)
            ->withTimestamps();
    }

    public function coursejob()
    {
        return $this->belongsToMany(Coursejob::class)
            ->withTimestamps();
    }
    public function skilljob()
    {
        return $this->belongsToMany(Skilljob::class)
            ->withTimestamps();
    }
    public function tagjob()
    {
        return $this->belongsToMany(Tagjob::class)
            ->withTimestamps();
    }
    public function typejob()
    {
        return $this->belongsToMany(Typejob::class)
            ->withTimestamps();
    }

    public function rolejob()
    {
        return $this->belongsToMany(Rolejob::class)
            ->withTimestamps();
    }

    public function languagejob()
    {
        return $this->belongsToMany(Languagejob::class)
            ->withTimestamps();
    }
    public function designationjob()
    {
        return $this->belongsToMany(Designationjob::class)
            ->withTimestamps();
    }

    public function statejob()
    {
        return $this->belongsTo(State::class);
    }

    public function cityjob()
    {
        return $this->belongsTo(City::class);
    }

    public function companyjob()
    {
        return $this->belongsTo(Companyjob::class);
    }

    public function competitiveexam()
    {
        return $this->belongsToMany(Competitiveexam::class)
            ->withTimestamps();
    }

    public function getCategorySelectAttribute()
    {
        return $this->categoryjob->pluck('id');
    }

    public function getBranchSelectAttribute()
    {
        return $this->branchjob->pluck('id');
    }

    public function getCourseSelectAttribute()
    {
        return $this->coursejob->pluck('id');
    }

    public function getSkillSelectAttribute()
    {
        return $this->skilljob->pluck('id');
    }
    public function getTagSelectAttribute()
    {
        return $this->tagjob->pluck('id');
    }

    public function getTypeSelectAttribute()
    {
        return $this->typejob->pluck('id');
    }

    public function getRoleSelectAttribute()
    {
        return $this->rolejob->pluck('id');
    }

    public function getLanguageSelectAttribute()
    {
        return $this->languagejob->pluck('id');
    }
    public function getDesignationSelectAttribute()
    {
        return $this->designationjob->pluck('id');
    }

    public function getCompetitiveexamSelectAttribute()
    {
        return $this->competitiveexam->pluck('id');
    }

    public function notificationlinkjob()
    {
        return $this->hasMany(Notificationlinkjob::class);
    }
}
