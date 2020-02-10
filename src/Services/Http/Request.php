<?php

namespace App\Services\Http;

class Request
{
    /**
     * Query string parameters ($_GET).
     *
     * @var ParameterBag
     */
    public $query;
    /**
     * Request body parameters ($_POST).
     *
     * @var ParameterBag
     */
    public $request;
    /**
     * Server and execution environment parameters ($_SERVER).
     *
     * @var ParameterBag
     */
    public $server;
    /**
     * Cookies ($_COOKIE).
     *
     * @var ParameterBag
     */
    public $cookies;

    /**
     * Request constructor.
     * @param array $query
     * @param array $request
     * @param array $cookies
     * @param array $server
     */
    public function __construct(array $query = [], array $request = [], array $cookies = [], array $server = [])
    {
        $this->initialize($query, $request, $cookies, $server);
    }

    /**
     * Sets the parameters for this request.
     *
     * @param array $query   The GET parameters
     * @param array $request The POST parameters
     * @param array $cookies The COOKIE parameters
     * @param array $server  The SERVER parameters
     */
    protected function initialize(array $query = [], array $request = [], array $cookies = [], array $server = [])
    {
        $this->query = new ParameterBag($query);
        $this->request = new ParameterBag($request);
        $this->cookies = new ParameterBag($cookies);
        $this->server = new ParameterBag($server);
    }
}