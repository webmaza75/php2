<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link href="/css/style.css" rel="stylesheet">

    <title>Добавление новости</title>
</head>
<body>
<h1>Добавление новости</h1>
<form method="post" action="/article.php">
    <label for="title">Заголовок</label>
    <input id="title" type="text" placeholder="Введите заголовок" name="title" required>
    <br>
    <label for="content">Текст</label>
    <textarea id=content" cols="100" rows="10" placeholder="Введите текст" name="content" required></textarea><br>
    <input name="add" type="submit" value="Добавить">
</form>
<a class="link" href="/">На главную</a>
</body>
</html>