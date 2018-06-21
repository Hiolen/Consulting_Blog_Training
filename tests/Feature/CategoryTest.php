<?php

namespace Tests\Feature;

use Tests\TestCase;

use Session;
use App\Category;

class CategoryTest extends TestCase
{

    public function testCategoryRoutes()
    {
        $this->login();
        $this->assertEquals(200, $this->call('GET', 'category')->getStatusCode());
        $this->assertEquals(200, $this->call('GET', 'category/create')->getStatusCode());
        $this->assertEquals(200, $this->call('GET', 'category/1/edit')->getStatusCode());
        $this->assertEquals(200, $this->call('GET', 'category/1/destroy')->getStatusCode());
    }

    public function testNameValidation()
    {
        $this->login()
            ->visit('/category/create')
            ->type('', 'name')
            ->press('Add Category')
            ->see('The name field is required.');
    }

    public function testStoreData()
    {

        $name = 'test';

        $this->login()
            ->visit('/category/create')
            ->type($name, 'name')
            ->press('Add Category')
            ->seeInDatabase('categories', [
                'name'  => $name,
            ]);
    }

    public function testUpdateData()
    {
        $name            = 'test';
        $updated_user_id = 1;

        $this->login()
            ->visit('user/1/edit')
            ->type($name, 'username')
            ->type($updated_user_id, 'first_name')
            ->press('Edit User')
            ->seeInDatabase('categories', [
                'name'  => $name,
                'updated_user_id' => $updated_user_id,
            ]);

    }

    public function testDelete()
    {
        Session::start();

        $category = new Category();
        $category = $category->find(1)->first();

        $this->seeInDatabase('categories', ['deleted_at' => null, 'id' => 1]);
        $response = $this->call('DELETE', 'category/1');
        $this->assertEquals(302, $response->getStatusCode());
    }
}
