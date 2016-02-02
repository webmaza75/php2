<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link href="../../../css/style.css" rel="stylesheet">
    <title>Админ-панель</title>
</head>
<body>
<h1>Админ-панель</h1>
<a class="link add" href="/Controllers/edit.php">Добавить новость</a><br>
<table>
<?php foreach ($news as $item): ?>
        <tr>
            <td>
                <strong><?php echo $item->title; ?></strong>
            </td>
            <td class="td">
                <a href="/Controllers/edit.php?id=<?php echo $item->id; ?>" class="edit">Редактировать</a>&nbsp;
            </td>
            <td class="td">
                <a href="/Controllers/del.php?id=<?php echo $item->id; ?>" class="del">Удалить</a>
            </td>
        </tr>
<?php endforeach; ?>
</table>
</body>
</html>