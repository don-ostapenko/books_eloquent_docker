<?php

namespace Tests\Services\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\Validation\Validation;

class ValidationTest extends TestCase
{
    public function testRequired()
    {
        $validation = new Validation();
        $validation->validate(['foo' => 'bar'], ['foo' => 'required']);
        $this->assertEquals(['foo' => 'bar'], $validation->getValidData());
    }

    public function testNumeric()
    {
        $validation = new Validation();
        $validation->validate(['foo' => '123'], ['foo' => 'numeric']);
        $this->assertEquals(['foo' => '123'], $validation->getValidData());
    }

    public function testEmail()
    {
        $validation = new Validation();
        $validation->validate(['foo' => 'example@domain.com'], ['foo' => 'email']);
        $this->assertEquals(['foo' => 'example@domain.com'], $validation->getValidData());
    }

    public function testBoolean()
    {
        $validation = new Validation();
        $validation->validate(['foo' => '1'], ['foo' => 'boolean']);
        $this->assertEquals(['foo' => '1'], $validation->getValidData());
    }

    public function testUrl()
    {
        $validation = new Validation();
        $validation->validate(['foo' => 'http://www.faqs.org/rfcs/rfc2396'], ['foo' => 'url']);
        $this->assertEquals(['foo' => 'http://www.faqs.org/rfcs/rfc2396'], $validation->getValidData());
    }

    public function testLength()
    {
        $validation = new Validation();
        $validation->validate(['foo' => '12345'], ['foo' => 'length:5']);
        $this->assertEquals(['foo' => '12345'], $validation->getValidData());
    }

    public function testString()
    {
        $validation = new Validation();
        $validation->validate(['foo' => 'bar'], ['foo' => 'string']);
        $this->assertEquals(['foo' => 'bar'], $validation->getValidData());
    }

    public function testSkip()
    {
        $validation = new Validation();
        $validation->validate(['foo' => ''], ['foo' => 'skip']);
        $this->assertEquals(['foo' => ''], $validation->getValidData());
    }

    public function testGetErrors()
    {
        $validation = new Validation();
        $validation->validate(['foo' => 'bar'], ['foo' => 'required']);
        $this->assertEmpty($validation->getErrors());
    }

    public function testFailValidation()
    {
        $validation = new Validation();
        $validation->validate(['foo' => '123'], ['foo' => 'length:5']);
        $this->assertEmpty($validation->getValidData());
    }
}