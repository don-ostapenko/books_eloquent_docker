<?php

namespace Tests\Unit\Support;

use PHPUnit\Framework\TestCase;
use App\Support\Cookie;

/**
 * Class CookieTest
 * @package Tests\Unit\Support
 * @runTestsInSeparateProcesses
 */
class CookieTest extends TestCase
{
    public function testHasCookie()
    {
        $this->assertTrue(Cookie::has('foo'));
    }

    public function testGetCookie()
    {
        $this->assertSame('bar', Cookie::get('foo'));
    }

    public function testGiveTrueWhenUnsetCookie()
    {
        $this->assertTrue(Cookie::unset('foo'));
    }

    public function testGiveFalseWhenUnsetCookie()
    {
        $this->assertFalse(Cookie::unset('bar'));
    }
}