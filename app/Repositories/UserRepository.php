<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
    private $userModel;

    /**
     * UserRepository constructor.
     *
     * @param User $userModel
     */
    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * Get all of the latest users for a given user.
     *
     * @return Collection
     */
    public function findAllUser() {
        return $this->userModel->latest()->paginate(10);
    }
}