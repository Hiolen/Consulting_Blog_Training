<?php

namespace Tests;

use Laravel\BrowserKitTesting\TestCase as BaseTestCase;
use App\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $baseUrl = 'http://localhost';

    public function login()
    {
        $user = new User([
            'id'         => 1,
            'username'   => 'test',
            'first_name' => 'test',
            'last_name'  => 'test',
            'password'   => bcrypt('secret'),
            'role'       => 1
        ]);

        $this->actingAs($user);

        return $this;
    }
}

