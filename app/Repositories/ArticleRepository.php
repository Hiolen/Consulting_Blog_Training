<?php

namespace App\Repositories;

use App\Article;
use App\Category;

class ArticleRepository
{
    private $articleModel;
    private $categoryModel;

    /**
     * ArticleRepository constructor.
     *
     * @param Article $articleModel
     * @param Category $categoryModel
     */
    public function __construct(Article $articleModel, Category $categoryModel)
    {
        $this->articleModel = $articleModel;
        $this->categoryModel = $categoryModel;
    }

    /**
     * Get all of the latest articles for a given article.
     *
     * @return Collection
     */
    public function findAllArticle() {
        return $this->articleModel->latest()->paginate(10);
    }

    /**
     * Get all of the category names for a given article.
     *
     * @return Collection
     */
    public function getAllCategoryName() {
        return $this->categoryModel->all()->pluck('id', 'name');
    }
}