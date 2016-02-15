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
        $this->view->ctrl = __CLASS__;
        $this->view->display(__DIR__ . '/../templates/admin/news.php');
    }

    protected function actionDelete()
    {
        $news = \App\Models\News::findById($_GET['id']);
        $news->delete();
        $this->view->ctrl = __CLASS__;
        $this->actionIndex();
    }

    protected function actionEdit()
    {
        if (!isset($_GET['id'])) {
            $this->view->news = new \App\Models\News();
        } else {
            $this->view->news = \App\Models\News::findById($_GET['id']);
        }
        $this->view->ctrl = __CLASS__;
        $this->view->display(__DIR__ . '/../templates/admin/edit.php');
    }

    protected function actionSave()
    {
        if (isset($_POST['id'])) {
            $this->view->news = \App\Models\News::findById((int)$_POST['id']);
        } else {
            $this->view->news = new \App\Models\News();
        }
        $this->view->news->setFromForm($_POST);
        $this->view->ctrl = __CLASS__;

        if ($this->view->news) {
            $this->view->news->save();
            $this->actionIndex();
        } else {
            $this->view->display(__DIR__ . '/../templates/admin/edit.php');
        }
    }
}