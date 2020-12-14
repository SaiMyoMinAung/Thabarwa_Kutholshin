<?php

namespace App;

use App\City;
use App\Office;
use App\TypeOfAdmin;
use App\Traits\HasUUID;
use Illuminate\Notifications\Notifiable;
use Znck\Eloquent\Traits\BelongsToThrough;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable, HasUUID, BelongsToThrough;

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

    public function city()
    {
        return $this->belongsToThrough(City::class, [Office::class]);
    }

    public function getUnreadNotis()
    {
        return $this->unreadNotifications()->orderBy('id', 'desc')->take(5)->get();
    }

    public function typeOfAdmin()
    {
        return $this->belongsTo(TypeOfAdmin::class, 'type_of_admin_id')->withDefault();
    }
}
