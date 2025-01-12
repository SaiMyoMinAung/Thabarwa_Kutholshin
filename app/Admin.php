<?php

namespace App;

use App\City;
use App\Office;
use App\StateRegion;
use App\Traits\HasUUID;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Znck\Eloquent\Traits\BelongsToThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable, HasUUID, BelongsToThrough, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'office_id'
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

    public function shareInternalDonatedItems()
    {
        return $this->hasMany(ShareInternalDonatedItem::class, 'admin_id');
    }
}
