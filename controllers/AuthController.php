<?php

namespace controllers;

use classes\App;
use classes\Controller;
use models\User;

/**
 * Class AuthController
 *
 * @package controllers
 */
class AuthController extends Controller
{
    /**
     * @return string
     */
    public function actionRegister()
    {
        $post = $this->getPost();
        $model = new User();
        if ($model->load($post) && $model->validate()) {
            $model->setPassword($post['password'] ?? '');
            if (App::getInstance()->userRepository->save($model)) {
                App::getInstance()->login($model);
                $this->redirect('/');
            }
        }

        // Failed
        $errorMessage = 'Registration has been failed!';
        if (!empty($model->getErrors())) {
            $errors = implode("</br> * ", $model->getErrors());
            $errorMessage .= '</br> * ' . $errors;
        }

        App::getInstance()->setFlashError('danger', $errorMessage);
        $this->redirect('/');
    }

    /**
     * @return string
     */
    public function actionLogin()
    {
        $post = $this->getPost();
        if (($post['username'] ?? false) && ($post['password'] ?? false)) {
            /** @var User[] $user */
            $user = App::getInstance()
                ->userRepository
                ->getByParams(
                    [
                        'username' => $post['username'],
                        'password' => App::getInstance()->security->cryptPassword($post['password'])
                    ],
                    null,
                    1
                );
            if ($user) {
                $user = $user[0];
                App::getInstance()->login($user);
                if (($post['remember_me'] ?? false)) {
                    setcookie('autoLogin', App::getInstance()->security->cryptPassword($user->getId()), (60 * 60 * 48));
                }
                $this->redirect('/');
            }
        }

        // Failed
        App::getInstance()->setFlashError('danger', 'Login is incorrect!');
        $this->redirect('/');
    }

    /**
     * return void
     */
    public function actionLogout()
    {
        App::getInstance()->logout();
        $this->redirect('/');
    }
}

