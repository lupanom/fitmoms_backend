<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $appends = ['id_mother','eta', 'height', 'is_pregnant', 'pregnancy_months', 'baby_months'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function mother()
    {
        return $this->hasOne(Mother::class);
    }

    public function getMotherIdAttribute()
    {
        return $this->mother->id;
    }

    public function getEtaAttribute()
    {
        $date = new Carbon($this->mother->birthday);
        return Carbon::today()->year - $date->year;
    }

    public function getHeightAttribute()
    {
        return $this->mother->height;
    }

    public function getIsPregnantAttribute()
    {
        return $this->mother->is_pregnant;
    }

    public function getPregnancyMonthsAttribute()
    {
        return $this->mother->pregnancy_months;
    }

    public function getBabyMonthsAttribute()
    {
        return $this->mother->baby_months;
    }
}
