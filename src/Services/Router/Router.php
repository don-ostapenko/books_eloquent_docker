<?php

namespace App\Services\Router;

use App\Exceptions\FileNotFoundException;
use App\Exceptions\NotFoundException;
use App\Support\Paths;

class Router
{
    /**
     * @var string
     */
    protected $route;

    /**
     * @var array
     */
    protected $routes = [];

    /**
     * @var null|array
     */
    protected $isRouteFound = null;

    /**
     * @param $route
     * @return string
     */
    protected function checkParam($route): string
    {
        if (!$route) {
            return '';
        }

        return $route;
    }

    /**
     * @param $path
     * @return array|null
     * @throws FileNotFoundException
     */
    protected function getRoutes($path): ?array
    {
        if (!file_exists($path)) {
            throw new FileNotFoundException('The file was not found');
        }

        return require $path;
    }

    /**
     * @param $route
     * @return $this
     */
    public function initParamsOfRoute($route)
    {
        try {
            $this->route = $this->checkParam($route);
            $this->routes = $this->getRoutes(Paths::getRootPath() . '/routes/routes.php');
        } catch (FileNotFoundException $e) {
            echo $e->getMessage();
        }

        return $this;
    }

    /**
     * @return HandlerRouter
     * @throws NotFoundException
     */
    public function handleRoute()
    {
        foreach ($this->routes as $pattern => $possibleRoute) {
            preg_match($pattern, $this->route, $matches);
            if (!empty($matches)) {
                $this->isRouteFound = $possibleRoute;
                break;
            }
        }

        if ($this->isRouteFound === null) {
            throw new NotFoundException('The route was not found');
        }

        unset($matches[0]);

        return new HandlerRouter($this->isRouteFound, $matches);
    }
}