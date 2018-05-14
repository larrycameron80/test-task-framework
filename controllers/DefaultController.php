<?php

namespace controllers;

use classes\App;
use classes\Controller;

/**
 * Class DefaultController
 *
 * @package controllers
 */
class DefaultController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $user = App::getInstance()->getUser();

        return $this->render('index', [
            'user' => $user
        ]);
    }
}
