<?php

namespace App\Repositories;

use App\Category;

class CategoryRepository
{
    private $categoryModel;

    /**
     * CategoryRepository constructor.
     *
     * @param Category $categoryModel
     */
    public function __construct(Category $categoryModel)
    {
        $this->categoryModel = $categoryModel;
    }

    /**
     * Get all of the latest users for a given user.
     *
     * @return Collection
     */
    public function findAllCategory() {
        return $this->categoryModel->latest()->paginate(10);
    }
}