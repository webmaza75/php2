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
        $id = (int)$_GET['id'];
        $news = \App\Models\News::findById($id);
        $news->delete();
        $this->actionIndex();
    }

    protected function actionEdit()
    {
        if (!isset($_GET['id'])) {
            $this->view->news = new \App\Models\News();
        } else {
            $this->view->news = \App\Models\News::findById((int)$_GET['id']);
        }
        $this->view->display(__DIR__ . '/../templates/admin/edit.php');
    }

    protected function checkForm()
    {
        $this->view->news->title = !empty($_POST['title']) ? $_POST['title'] : null;
        $this->view->news->content = !empty($_POST['content']) ? $_POST['content'] : null;
        $res = (!is_null($this->view->news->title) || !is_null($this->view->news->content)) ? true : false;
        return $res;
    }

    protected function setAuthor()
    {
        $author = $_POST['author'];
        $author_id = $_POST['author_id'];

        $this->view->news->author_id = (!empty($author_id)) ? $author_id : NULL;

        if (!empty($author) && is_numeric($author)) {
            $auth = \App\Models\Author::findById((int)$author);
            if ($auth) {
                $this->view->news->author_id = $auth->id;
            } else {
                return false;
            }
        }

        if (empty($author)) {
            $this->view->news->author_id = null;
        }
        return true;
    }

    protected function actionSave()
    {
        if (isset($_POST['id'])) {
            $this->view->news = \App\Models\News::findById((int)$_POST['id']);
        } else {
            $this->view->news = new \App\Models\News();
        }

        $res = $this->checkForm();

        if ($res && $this->setAuthor()) {
            $this->view->news->save();
            header('location: /?ctrl=Admin');
            exit;
        } else {
            $this->view->display(__DIR__ . '/../templates/admin/edit.php');
        }
    }
}