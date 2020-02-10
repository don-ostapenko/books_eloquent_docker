<?php

namespace App\Services\Di\Config;

use App\Services\Http\Request;
use App\Services\Pagination;
use App\Services\Router\Router;
use App\Services\Validation\Validation;
use App\Services\Di\Reference\ParameterReference as PR;
use App\Services\Di\Reference\ServiceReference as SR;
use App\Support\Paths;
use App\View\View;

class DiArgument
{
    /**
     * @var array
     */
    protected $services;

    /**
     * @var array
     */
    protected $parameters;

    /**
     * DiArgument constructor.
     */
    public function __construct()
    {
        $this->services = [
            Router::class => [
                'class' => Router::class,
                'arguments' => []
            ],
            Validation::class => [
                'class' => Validation::class,
                'arguments' => []
            ],
            Pagination::class => [
                'class' => Pagination::class,
                'arguments'
            ],
            View::class => [
                'class' => View::class,
                'arguments' => [
                    new PR('view.template_path'),
                ]
            ],
            Request::class => [
                'class' => Request::class,
                'arguments' => [
                    new PR('request.query'),
                    new PR('request.request'),
                    new PR('request.cookies'),
                    new PR('request.server'),
                ]
            ]
        ];

        $this->parameters = [
            'view' => [
                'template_path' => Paths::getTemplatePath()
            ],
            'request' => [
                'query' => $_GET,
                'request' => $_POST,
                'cookies' => $_COOKIE,
                'server' => $_SERVER
            ]
        ];
    }

    /**
     * Retrieve services from the config.
     *
     * @return array The services
     */
    public function getServices(): array
    {
        return $this->services;
    }

    /**
     * Retrieve parameters from the config
     *
     * @return array The parameters
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }
}