<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link href="/css/style.css" rel="stylesheet">
    <title>Просмотр новости</title>
</head>
<body>
<h1>Просмотр новости</h1>
<h2><?php echo $news->title; ?></h2>
<div><?php echo $news->content; ?></div>
<p><a class="link" href="/">На главную</a></p>
</body>
</html>