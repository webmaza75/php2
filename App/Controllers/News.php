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
        if (!$this->view->news) {
            throw new \App\Exceptions\Err404 ('Новости не найдены');
        }
        $this->view->display(__DIR__ . '/../templates/index.php');
    }

    protected function actionOne()
    {
        $this->view->news = \App\Models\News::findById($_GET['id']);
        if (!$this->view->news) {
            throw new \App\Exceptions\Err404 ('Новость не найдена');
        }
        $this->view->display(__DIR__ . '/../templates/one.php');
    }
}
