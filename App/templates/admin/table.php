<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Админ-панель</title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    <h1>Админ-панель</h1>
    <div>
        <a class="btn btn-success" aria-label="Left Align" href="/admin/edit">
            <span class="glyphicon glyphicon-plus">Добавить новость</span>
        </a>
    </div><br>

    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Заголовок</th>
            <th>Автор</th>
            <th>Редактировать</th>
            <th>Удалить</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($news as $row): ?>
            <tr>
                <?php foreach ($row as $col): ?>
                    <td><?php echo $col ?></td>
                <?php endforeach; ?>

                <td>
                    <a class="btn btn-sm btn-primary" href="/admin/edit?id=<?php echo $row[0]; ?>">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                </td>
                <td>
                    <a class="btn btn-sm btn-danger" href="/admin/delete?id=<?php echo $row[0]; ?>">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>

</div>
<br><br>
<div class="container-fluid">
    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="container">
            <p class="text-center"><strong>Время | память:</strong> <?php echo $time; ?></p>
        </div>
    </nav>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>