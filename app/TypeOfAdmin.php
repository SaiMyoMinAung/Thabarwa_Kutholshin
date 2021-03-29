<?php

namespace App;

use App\Admin;
use Illuminate\Database\Eloquent\Model;

class TypeOfAdmin extends Model
{
    protected $guarded = [];

    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'admin_has_type_of_admins', 'type_of_admin_id', 'admin_id');
    }
}
