<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link href="../../../css/style.css" rel="stylesheet">
    <title>Добавление / Редактирование новости</title>
</head>
<body>
<h1>Редактирование новости</h1>
<form action="/Controllers/save.php" method="post">
    <label for="title">Заголовок</label>
    <input id="title" name="title" type="text" placeholder="Введите заголовок" value="<?php echo $news->title; ?>" required>
    <br>
    <label for="content">Текст</label>
    <textarea id=content" name="content" cols="100" rows="10" placeholder="Введите текст" required><?php echo $news->content; ?></textarea><br>
    <?php if ($news->id) { echo '<input type="hidden" name="id" value="' . $news->id .'">'; } ?>
    <input name="edit" type="submit" value="Сохранить">
</form>
<a class="link" href="/">На главную</a>
</body>
</html>

