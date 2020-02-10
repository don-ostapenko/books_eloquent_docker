<?php

namespace Tests\Unit\Services\Http;

use PHPUnit\Framework\TestCase;
use App\Services\Http\ParameterBag;

class ParameterBagTest extends TestCase
{

    public function testConstructor()
    {
        $this->testAll();
    }

    public function testAll()
    {
        $bag = new ParameterBag(['foo' => 'bar']);
        $this->assertEquals(['foo' => 'bar'], $bag->all());
    }

    public function testKeys()
    {
        $bag = new ParameterBag(['foo' => 'bar']);
        $this->assertEquals(['foo'], $bag->keys());
    }

    public function testReplace()
    {
        $bag = new ParameterBag(['foo' => 'bar']);
        $bag->replace(['bar' => 'var']);
        $this->assertEquals(['bar' => 'var'], $bag->all());
    }

    public function testAdd()
    {
        $bag = new ParameterBag(['foo' => 'bar']);
        $bag->add(['bar' => 'var', 'foo' => 'lar']);
        $this->assertEquals(['foo' => 'lar', 'bar' => 'var'], $bag->all());
    }

    public function testGet()
    {
        $bag = new ParameterBag(['foo' => 'bar']);
        $this->assertEquals('bar', $bag->get('foo'));
    }

    public function testSet()
    {
        $bag = new ParameterBag(['foo' => 'bar']);
        $bag->set('bar', 'var');
        $this->assertEquals(['foo' => 'bar', 'bar' => 'var'], $bag->all());
    }

    public function testHas()
    {
        $bag = new ParameterBag(['foo' => 'bar']);
        $this->assertTrue($bag->has('foo'));
    }

    public function testRemove()
    {
        $bag = new ParameterBag(['foo' => 'bar', 'bar' => 'var']);
        $bag->remove('bar');
        $this->assertEquals(['foo' => 'bar'], $bag->all());
    }
}