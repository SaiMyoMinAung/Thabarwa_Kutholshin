<?php

namespace App;

use App\City;
use App\Office;
use App\StateRegion;
use App\TypeOfAdmin;
use App\Traits\HasUUID;
use Illuminate\Notifications\Notifiable;
use Znck\Eloquent\Traits\BelongsToThrough;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable, HasUUID, BelongsToThrough, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'type_of_admin_id', 'office_id'
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
        return $this->belongsTo(Office::class, 'office_id')->withTrashed()->withDefault();
    }

    public function city()
    {
        return $this->belongsToThrough(City::class, [Center::class, Office::class])->withTrashed()->withDefault();
    }

    public function center()
    {
        return $this->belongsToThrough(Center::class, [Office::class])->withTrashed()->withDefault();
    }

    public function stateRegion()
    {
        return $this->belongsToThrough(StateRegion::class, [City::class, Center::class, Office::class])->withTrashed()->withDefault();
    }

    public function getUnreadNotis()
    {
        return $this->unreadNotifications()->orderBy('id', 'desc')->take(5)->get();
    }

    public function typeOfAdmins()
    {
        return $this->belongsToMany(TypeOfAdmin::class, 'admin_has_type_of_admins', 'admin_id', 'type_of_admin_id');
    }
}
