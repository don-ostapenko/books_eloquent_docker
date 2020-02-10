<?php

namespace Tests\Unit\Support;

use App\Models\Users\UserInterface;
use App\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use App\Support\UsersAuth;
use App\Services\Migration;

/**
 * Class UsersAuthTest
 * @package Tests\Unit\Support
 * @runTestsInSeparateProcesses
 */
class UsersAuthTest extends TestCase
{
    protected function setUp(): void
    {
        Migration::connectToDb();
    }

    public function testLoginThatUserExist()
    {
        $data = ['email' => 'admin@gmail.com', 'pass' => 'pass'];
        $this->assertInstanceOf(UserInterface::class, UsersAuth::login($data));
    }

    public function testLoginThatEmailNotExist()
    {
        $data = ['email' => 'foo', 'pass' => 'pass'];
        $this->expectException(InvalidArgumentException::class);
        UsersAuth::login($data);
    }

    public function testLoginThatPassIsInvalid()
    {
        $data = ['email' => 'admin@gmail.com', 'pass' => 'foo'];
        $this->expectException(InvalidArgumentException::class);
        UsersAuth::login($data);
    }

    public function testThatUserIsAuthorized()
    {
        $user = UsersAuth::getUserByToken();
        $this->assertSame('user@gmail.com', $user->email);
    }
}