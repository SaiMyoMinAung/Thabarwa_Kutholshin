<?php

namespace App;

use App\Admin;
use App\Store;
use App\Center;
use App\Volunteer;
use App\Traits\HasUUID;
use App\InternalDonatedItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model
{
    use HasUUID, SoftDeletes;

    protected $guarded = [];

    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id')->withTrashed()->withDefault();
    }

    public function stores()
    {
        return $this->hasMany(Store::class, 'office_id');
    }

    public function boxes()
    {
        return $this->hasManyThrough(Box::class, Store::class, 'office_id', 'store_id');
    }

    public function volunteers()
    {
        return $this->hasMany(Volunteer::class);
    }

    public function admins()
    {
        return $this->hasMany(Admin::class, 'office_id');
    }

    public function internalDonatedItems()
    {
        return $this->hasMany(InternalDonatedItem::class, 'office_id');
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_open', 1)->orderBy('id', 'desc');
    }
}
