<?php

namespace App\Controllers;

use App\Controller;

/**
 * Class News
 * @package App\Controllers
 * @property object $view
 * @property object $news
 */
class News extends Controller
{
    protected function actionIndex()
    {
        $this->view->news = \App\Models\News::findAll();
        $this->view->ctrl = __CLASS__;
        $this->view->display(__DIR__ . '/../templates/index.php');
    }

    protected function actionOne()
    {
        $this->view->news = \App\Models\News::findById($_GET['id']);
        $this->view->display(__DIR__ . '/../templates/one.php');
    }

    protected function action404()
    {
        $this->view->display(__DIR__ . '/../templates/404.php');
    }
}
