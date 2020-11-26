<?php

namespace App;

use App\Office;
use App\StateRegion;
use App\Traits\HasUUID;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable, HasUUID;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id')->withDefault();
    }

    public function stateRegion()
    {
        return $this->belongsTo(StateRegion::class, 'state_region_id')->withDefault();
    }

    public function getUnreadNotis()
    {
        return $this->unreadNotifications()->orderBy('id', 'desc')->take(5)->get();
    }
}
