<?php

namespace App;

use App\Team;
use App\Center;
use App\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

class StateRegion extends Model
{
    use HasRelationships, SoftDeletes;

    protected $guarded = [];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id')->withTrashed()->withDefault();
    }

    public function centers()
    {
        return $this->hasManyThrough(Center::class, City::class, 'state_region_id', 'city_id');
    }

    public function teams()
    {
        return $this->hasManyDeep(Team::class, [City::class, Center::class]);
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, City::class, 'state_region_id', 'city_id');
    }

    public function yogis()
    {
        return $this->hasManyThrough(Yogi::class, City::class, 'state_region_id', 'city_id');
    }
}
