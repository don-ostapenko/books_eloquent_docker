<?php

namespace App;

use App\Exceptions\ForbiddenException;
use App\Exceptions\UnauthorizedException;
use App\Exceptions\InvalidArgumentException;
use App\Exceptions\NotFoundException;
use App\Services\Di\DiContainer;
use App\Services\Http\Request;
use App\Services\Migration;
use App\Services\Router\Router;
use App\View\View;

class Initialization
{
    /**
     * @var DiContainer
     */
    protected $di;

    /**
     * @var Router
     */
    protected $router;

    /**
     * @var Request
     */
    protected $request;

    /**
     * Initialization constructor.
     * @param DiContainer $di
     * @throws
     */
    public function __construct(DiContainer $di)
    {
        $this->di = $di;
        $this->router = $di->get(Router::class);
        $this->request = $di->get(Request::class);
        Migration::connectToDb();
    }

    /**
     * @throws
     */
    public function init()
    {
        try {
            $handledRoute = $this->router->initParamsOfRoute($this->request->query->get('route'))->handleRoute();
            $controller = $handledRoute->getController();
            call_user_func_array([new $controller($this->di), $handledRoute->getAction()], $handledRoute->getParams());
        } catch (NotFoundException | \PDOException | InvalidArgumentException $e) {
            echo $e->getMessage();
            exit();
        } catch (UnauthorizedException $e) {
            $view = $this->di->get(View::class);
            $view->renderHtml('errors/401', ['error' => $e->getMessage()], 401);
        } catch (ForbiddenException $e) {
            $view = $this->di->get(View::class);
            $view->renderHtml('errors/403', ['error' => $e->getMessage()], 403);
        }
    }
}