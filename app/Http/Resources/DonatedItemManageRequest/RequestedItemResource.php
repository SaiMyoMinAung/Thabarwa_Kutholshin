<?php

namespace App\Http\Resources\DonatedItemManageRequest;

use App\Team;
use App\User;
use App\Yogi;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Select2\VolunteerSelect2Resource;
use App\Http\Resources\DonatedItemManageRequest\UserResource;
use App\Http\Resources\DonatedItemManageRequest\YogiResource;

class RequestedItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'request_no' => $this->request_no,
            'qty' => $this->qty,
            'status' => $this->statusName,
            'delivered_volunteer_id' => $this->delivered_volunteer_id,
            'delivered_volunteer' => new VolunteerSelect2Resource($this->deliveredVolunteer),
            'is_delivering' => (bool) $this->is_delivering,
            'is_done_delivering' => (bool) $this->is_done_delivering,
            'is_complete' => (bool) $this->is_complete,
            'is_cancel' => (bool) $this->is_cancel,
            'requested_user' => $this->identifyRequestedUser()
        ];
    }

    public function identifyRequestedUser()
    {
        if ($this->requestable_type == get_class(new User)) {
            return new UserResource($this->requestable);
        }

        if ($this->requestable_type == get_class(new Team)) {
            return new TeamResource($this->requestable);
        }

        if ($this->requestable_type == get_class(new Yogi)) {
            return new YogiResource($this->requestable);
        }
    }
}
