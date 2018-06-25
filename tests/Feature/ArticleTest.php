<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Article;
use Session;

class ArticleTest extends TestCase
{
    public function testCategoryRoutes()
    {
        $this->login();
        $this->assertEquals(200, $this->call('GET', 'article')->getStatusCode());
        $this->assertEquals(200, $this->call('GET', 'article/create')->getStatusCode());
        $this->assertEquals(200, $this->call('GET', 'article/1/edit')->getStatusCode());
        $this->assertEquals(200, $this->call('GET', 'article/1/destroy')->getStatusCode());
    }

    public function testTitleValidation()
    {
        $this->login()
            ->visit('/article/create')
            ->type('', 'title')
            ->press('Add Article')
            ->see('The title field is required.');
    }

    public function testStoreData()
    {

        $title  = 'test';

        $this->login()
            ->visit('/article/create')
            ->type($title, 'title')
            ->press('Add Article')
            ->seeInDatabase('articles', [
                'title'  => $title,
            ]);
    }

    public function testUpdateData()
    {
        $title   = 'test';

        $this->login()
            ->visit('article/1/edit')
            ->type($title, 'title')
            ->press('Edit Article')
            ->seeInDatabase('articles', [
                'title'  => $title,
            ]);
    }

    public function testDelete()
    {
        Session::start();

        $article = new Article();
        $article = $article->find(1)->first();

        $this->seeInDatabase('articles', ['deleted_at' => null, 'id' => 1]);
        $response = $this->call('DELETE', 'article/1');
        $this->assertEquals(302, $response->getStatusCode());
    }
}
