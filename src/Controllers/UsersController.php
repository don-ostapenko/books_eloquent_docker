<?php

namespace App\Controllers;

use App\Support\Cookie;
use App\Support\UsersAuth;
use App\Exceptions\InvalidArgumentException;

class UsersController extends AbstractController
{
    protected $signInRules = [
        'email' => 'required',
        'pass' => 'required'
    ];

    public function signIn()
    {
        if ($_POST) {
            $data = $this->request->request->all();
            $this->validator->validate($data, $this->signInRules);

            if (!$this->validator->getErrors()) {
                try {
                    $user = UsersAuth::login($this->validator->getValidData());
                    UsersAuth::createToken($user);
                    echo $this->view->renderHtml('result/page.result', [
                        'class' => 'alert-success',
                        'message' => 'The authorization was a success.'
                    ]);
                    return;
                } catch (InvalidArgumentException $e) {
                    echo $this->view->renderHtml('users/signIn', [
                        'title' => 'Sign in',
                        'error' => $e->getMessage()
                    ]);
                    return;
                }
            } else {
                echo $this->view->renderHtml('users/signIn', [
                    'title' => 'Sign in',
                    'errors' => $this->validator->getErrors()
                ]);
                return;
            }
        }

        echo $this->view->renderHtml('users/signIn', [
            'title' => 'Sign in',
        ]);
    }

    public function signOut()
    {
        Cookie::unset('auth_token');
        header('Location: /');
    }
}