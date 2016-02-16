<?php

namespace App\Controllers;

use App\Controller;
//use App\Models\Author;

/**
 * Class Admin
 * @package App\Controllers
 * @property object $view
 * @property object $news (для action Delete)
 */
class Admin extends Controller
{
    protected function actionIndex()
    {
        $this->view->news = \App\Models\News::findAll();
        $this->view->display(__DIR__ . '/../templates/admin/news.php');
    }

    protected function actionDelete()
    {
        $news = \App\Models\News::findById($_GET['id']);
        $news->delete();
        $this->actionIndex();
    }

    protected function actionEdit()
    {
        if (!isset($_GET['id'])) {
            $this->view->news = new \App\Models\News();
        } else {
            $this->view->news = \App\Models\News::findById($_GET['id']);
        }
        $this->view->display(__DIR__ . '/../templates/admin/edit.php');
    }

    protected function actionSave()
    {
        if (isset($_POST['id'])) {
            $news = \App\Models\News::findById((int)$_POST['id']);
        } else {
            $news = new \App\Models\News();
        }
        $news->setFromForm($_POST);

        if ($news) {
            $news->save();
            header('Location: /admin/index');
            exit;
        } else {
            $this->view->news = $news;
            $this->view->display(__DIR__ . '/../templates/admin/edit.php');
        }
    }
}