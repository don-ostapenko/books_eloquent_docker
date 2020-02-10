<?php

namespace Tests\Unit\Services\Router;

use App\Exceptions\NotFoundException;
use App\Services\Router\HandlerRouter;
use PHPUnit\Framework\TestCase;
use App\Services\Router\Router;

class RouterTest extends TestCase
{
    public function testThatWillReceiveInstanceOfHandlerRouter()
    {
        $router = new Router();
        $this->assertInstanceOf(HandlerRouter::class, $router->initParamsOfRoute('admin')->handleRoute());
    }

    public function testThatReceiveExceptionByWrongRoute()
    {
        $router = new Router();
        $this->expectException(NotFoundException::class);
        $router->initParamsOfRoute('foo')->handleRoute();
    }
}