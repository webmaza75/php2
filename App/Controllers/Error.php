<?php

namespace App\Controllers;

use App\Controller;

/**
 * Class Error
 * @package App\Controllers
 * @property object App\View
 */
class Error extends Controller
{
    public function action404($error)
    {
        $this->view->error = $error;
        $this->view->display(__DIR__.'/../templates/404.php');
    }

    public function actionDbError($error)
    {
        $this->view->error = $error;
        $this->view->display(__DIR__.'/../templates/db_error.php');
    }
}