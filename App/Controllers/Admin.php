<?php

namespace App\Controllers;

use App\Controller;


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
         if (!$this->view->news) {
             throw new \App\Exceptions\Err404 ('Новости не найдены');
         }
        $this->view->display(__DIR__ . '/../templates/admin/news.php');
    }

    protected function actionDelete()
    {
        $news = \App\Models\News::findById($_GET['id']);
        if (!$news) {
            throw new \App\Exceptions\Err404 ('Новость не найдена');
        }
        $news->delete();
        header('Location: /admin/index');
        exit;
    }

    protected function actionEdit()
    {
        if (!isset($_GET['id'])) {
            $this->view->news = new \App\Models\News();
        } else {
            $this->view->news = \App\Models\News::findById($_GET['id']);

            if (!$this->view->news) {
                throw new \App\Exceptions\Err404 ('Новость не найдена');
            }
        }
        $this->view->display(__DIR__ . '/../templates/admin/edit.php');
    }

    protected function actionSave()
    {
        try {
            if (isset($_POST['id'])) {
                $news = \App\Models\News::findById($_POST['id']);
                if (!$news) {
                    throw new \App\Exceptions\Err404 ('Новость не найдена');
                }
            } else {
                $news = new \App\Models\News();
            }
            $news->fill($_POST);
            $news->save();
            header('Location: /admin/index');
            exit;
        } catch (\App\MultiException $e) {
            $this->view->errors = $e;
            \App\Logger::putArrContent($e);
            $this->view->news = $news;
            $this->view->display(__DIR__ . '/../templates/admin/edit.php');
        }
    }
}