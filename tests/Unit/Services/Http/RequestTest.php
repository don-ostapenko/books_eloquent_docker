<?php

namespace Tests\Unit\Services\Http;

use PHPUnit\Framework\TestCase;
use App\Services\Http\Request;

class RequestTest extends TestCase
{
    public function testConstructor()
    {
        $request = new Request(['foo' => 'bar']);
        $this->assertEquals(['foo' => 'bar'], $request->query->all());
    }
}