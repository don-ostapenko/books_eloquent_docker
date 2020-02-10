<?php

namespace Tests\Unit\Services\Router;

use PHPUnit\Framework\TestCase;
use App\Services\Router\HandlerRouter;

class HandlerRouterTest extends TestCase
{
    protected $handlerRouter;

    protected function setUp(): void
    {
        $handledRoute = [
            'App\Controllers\AdminController',
            'editBook'
        ];
        $params = [
            '1'
        ];

        $this->handlerRouter = new HandlerRouter($handledRoute, $params);
    }

    public function testGetController()
    {
        $this->assertSame('App\Controllers\AdminController', $this->handlerRouter->getController());
    }

    public function testGetAction()
    {
        $this->assertSame('editBook', $this->handlerRouter->getAction());
    }

    public function testGetParams()
    {
        $this->assertSame(['1'], $this->handlerRouter->getParams());
    }

    protected function tearDown(): void
    {
        unset($this->handlerRouter);
    }
}