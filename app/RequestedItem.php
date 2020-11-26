<?php

namespace App;

use App\Volunteer;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use App\State\ManageRequest\RequestedItemState;
use App\Status\RequestedItemStatus;

class RequestedItem extends Model
{
    use HasUUID;

    protected $guarded = [];

    public function setRequestNoAttribute()
    {
        $count = static::count();

        $defaultPadLeft = 6;

        do {
            $numlength = strlen((string) $count);

            if ($numlength >= 6 && preg_match("/^[9]+$/i", $count)) {

                $defaultPadLeft = $numlength + 1;

                $count = 0;
            }

            $count++;

            $request_no = str_pad($count, $defaultPadLeft, "0", STR_PAD_LEFT);
        } while (static::where('request_no', $request_no)->exists());

        $text = (string) $request_no; // convert into a string

        $arr = str_split($text, "3"); // break string in 3 character sets

        $formatted_request_no = implode("-", $arr);  // implode array with comma

        $this->attributes['request_no'] = $formatted_request_no;
    }

    public function getStateAttribute(): RequestedItemState
    {
        return new $this->state_class($this);
    }

    public function getStatusNameAttribute()
    {
        return RequestedItemStatus::search($this->status);
    }

    /**
     * Get the owning requestable model.
     */
    public function requestable()
    {
        return $this->morphTo();
    }

    public function deliveredVolunteer()
    {
        return $this->belongsTo(Volunteer::class, 'delivered_volunteer_id')->withDefault();
    }
}
