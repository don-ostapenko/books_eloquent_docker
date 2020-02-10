<?php

namespace App\Controllers;

use App\Exceptions\ServiceNotFoundException;
use App\Models\Users\User;
use App\Services\Di\DiContainer;
use App\Services\Pagination;
use App\Services\Validation\Validation;
use App\Services\Http\Request;
use App\Support\UsersAuth;
use App\View\View;

abstract class AbstractController
{
    /**
     * @var View
     */
    protected $view;

    /**
     * @var User|null
     */
    protected $user;

    /**
     * @var Pagination
     */
    protected $pagination;

    /**
     * @var Validation
     */
    protected $validator;

    /**
     * @var array
     */
    protected $searchRules = [
        'search' => 'required|string',
    ];

    /**
     * @var Request
     */
    protected $request;

    /**
     * AbstractController constructor.
     * @param DiContainer $di
     * @throws ServiceNotFoundException
     */
    public function __construct($di)
    {
        $this->user = UsersAuth::getUserByToken();
        $this->request = $di->get(Request::class);
        $this->validator = $di->get(Validation::class);
        $this->pagination = $di->get(Pagination::class);
        $this->view = $di->get(View::class);
        $this->view->setVar('user', $this->user);
    }

    protected function renderPagination(Pagination $paginatorInstance)
    {
        $html = '';
        ob_start();
        echo $this->view->renderHtml('pagination/template.pagination', [
            'paginatorInstance' => $paginatorInstance,
        ]);
        $html .= ob_get_clean();
        return $html;
    }
}