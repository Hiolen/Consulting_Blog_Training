<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
    private $model;

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Get all of the latest users for a given user.
     *
     * @return Collection
     */
    public function findAllUser() {
        return $this->model->latest()->paginate(10);
    }
}