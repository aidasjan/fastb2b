<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UserTest extends TestCase
{
    
    public function testUserIsAdmin()
    {
        $user = new User;
        $user->role = 'admin';
        $this->assertTrue($user->isAdmin());
        $user->role = 'client';
        $this->assertFalse($user->isAdmin());
    }

    public function testUserIsClient()
    {
        $user = new User;
        $user->role = 'admin';
        $this->assertFalse($user->isClient());
        $user->role = 'client';
        $this->assertTrue($user->isClient());
    }
}
