<?php

namespace MichelMelo\JazzRh\Tests\Unit;

use MichelMelo\JazzRh\Services\UserService;
use MichelMelo\JazzRh\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class UserServiceTest extends TestCase
{
    #[Test]
    public function it_can_create_a_user()
    {
        $service = app(UserService::class);

        $user = $service->createUser([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => bcrypt('password123'),
            'role' => 'recruiter',
        ]);

        $this->assertNotNull($user->id);
        $this->assertEquals('jane@example.com', $user->email);
    }

    #[Test]
    public function it_can_get_user_by_id()
    {
        $service = app(UserService::class);

        $user = $service->createUser([
            'name' => 'John Smith',
            'email' => 'john.smith@example.com',
            'password' => bcrypt('password123'),
            'role' => 'manager',
        ]);

        $retrieved = $service->getUserById($user->id);

        $this->assertNotNull($retrieved);
        $this->assertEquals('john.smith@example.com', $retrieved->email);
    }
}
