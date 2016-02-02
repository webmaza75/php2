<?php
/**
 * 1. Проверьте, что от пользователя что-то пришло
 * 2. ЕСЛИ пришло нужное, ТО попытайтесь создать и сохранить модель
 * 3. ЕСЛИ пункт 2. удался - то перенаправьте пользователя куда-нибудь, хоть на ту же страницу.
 * Не забудьте остановить программу после перенаправления!
 * 4. А вот тут покажите форму
 *******
 * - edit(NEW)
 * - edit(id=NNN)
 * - save()
 */
use App\Models\News;

require_once __DIR__ . '/../autoload.php';

if (isset($_POST['title']) && isset($_POST['content'])) {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    if ($title != '' && $content != '') {
        $news = new News();
        $news->title = $title;
        $news->content = $content;
        if ($news->save()) {
            header('location: /');
            exit;
        }
    }
}
include(__DIR__ . '/../App/views/news/add.php');