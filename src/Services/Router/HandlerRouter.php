<?php

namespace App\Services\Router;

use App\Controllers\AbstractController;

class HandlerRouter
{
    /**
     * @var string
     */
    protected $controller;

    /**
     * @var string
     */
    protected $action;

    /**
     * @var array
     */
    protected $params;

    /**
     * DispatchedRoute constructor.
     * @param array $handledRoute
     * @param array $params
     */
    public function __construct(array $handledRoute, array $params)
    {
        $this->controller = $handledRoute[0];
        $this->action = $handledRoute[1];
        $this->params = $params;
    }

    /**
     * @return AbstractController
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}