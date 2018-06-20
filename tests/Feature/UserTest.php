<?php

namespace Tests\Feature;

use function PHPSTORM_META\type;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Session;
use App\User;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserRoutes()
    {
        $this->login();
        $this->assertEquals(200, $this->call('GET', 'user')->getStatusCode());
        $this->assertEquals(200, $this->call('GET', 'user/create')->getStatusCode());
        $this->assertEquals(200, $this->call('GET', 'user/1/edit')->getStatusCode());
        $this->assertEquals(200, $this->call('GET', 'user/1/destroy')->getStatusCode());
    }

    public function testUsernameValidation()
    {
        $this->login()
            ->visit('/user/create')
            ->type('', 'username')
            ->press('Add User')
            ->see('The username field is required.');

    }

    public function testFirstNameValidation()
    {
        $this->login()
            ->visit('/user/create')
            ->type('', 'first_name')
            ->press('Add User')
            ->see('The first name field is required.');

    }

    public function testLastNameValidation()
    {
        $this->login()
            ->visit('/user/create')
            ->type('', 'last_name')
            ->press('Add User')
            ->see('The last name field is required.');

    }

    public function testPasswordValidation()
    {
        $this->login()
            ->visit('/user/create')
            ->type('', 'password')
            ->press('Add User')
            ->see('The password field is required.');

    }

    public function testStoreData()
    {
        $username   = 'test';
        $first_name = 'test';
        $last_name  = 'test';
        $role       = 0;

        $this->login()
            ->visit('/user/create')
            ->type($username, 'username')
            ->type($first_name, 'first_name')
            ->type($last_name, 'last_name')
            ->press('Add User')
            ->seeInDatabase('users', [
                'username'      => $username,
                'first_name'    => $first_name,
                'last_name'     => $last_name,
                'role'      => $role,
            ]);
    }

    public function testUpdateData()
    {
        $username   = 'test';
        $first_name = 'test';
        $last_name  = 'test';
        $role       = 0;
        $password   = bcrypt('secret!');

        $this->login()
            ->visit('user/1/edit')
            ->type($username, 'username')
            ->type($first_name, 'first_name')
            ->type($last_name, 'last_name')
            ->type($role, 'role')
            ->type($password, 'password')
            ->press('Edit User');
    }

    public function testDelete()
    {
        Session::start();

        $user = new User();
        $user = $user->find(1)->first();
        $this->actingAs($user);
        $this->seeInDatabase('users', ['deleted_at' => null, 'id' => 1]);
        $response = $this->call('POST', 'user/1/destroy', ['_token' => csrf_token()]);
        $this->assertEquals(302, $response->getStatusCode());
    }
}
