<?php

namespace App\Repository;

use App\User;

class UserRepository extends BaseRepository
{
    public $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }
}
