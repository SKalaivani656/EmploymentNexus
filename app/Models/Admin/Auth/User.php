<?php

namespace App\Models\Admin\Auth;

use Cache;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_login_at', 'last_login_ip', 'father_name', 'dob', 'doj', 'phone',
        'phone_two', 'address', 'city', 'state', 'pincode', 'experience', 'previous_company',
        'enable2fa', 'otpstatus', 'google2fa_secret', 'comments', 'confirmed', 'active_flag', 'slack',
        'last_session', 'bank_name', 'account_no', 'ifsc_code', 'branch', 'pan_no', 'aadhar_no',
        'remarks', 'uuid', 'sys_id', 'uniqid', 'sequence_id', 'user_id', 'created_by', 'status',
        'active', 'active_record', 'flag', 'edu_qualification', 'dor', 'relieving_reason', 'is_accountactive',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
            $model->api_token = Str::random(40);
        });
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::needsRehash($password) ? Hash::make($password) : $password;
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->uuid);
    }

    public function passwordSecurity()
    {
        return $this->hasOne('App\Models\Admin\Settings\PasswordSecurity');
    }

}
