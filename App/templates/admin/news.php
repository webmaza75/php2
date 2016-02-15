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
    <a class="btn btn-success" aria-label="Left Align" href="?ctrl=admin&act=edit">
        <span class="glyphicon glyphicon-plus"> Добавить новость</span>
    </a>
</div><br>

<?php foreach ($news as $item) : ?>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">
                <?php if (!empty($item->title)) : ?>
                    <?php echo $item->title; ?>
                <?php else : ?>
                    -= Без заголовка =-
                <?php endif; ?>
            </h3>
        </div>
        <div class="panel-body"> Автор:
            <?php if (!empty($item->author)) : ?>
                <?php echo $item->author->name; ?>
                <?php else : ?>
                    не указан
            <?php endif; ?>

            <div class="pull-right">
                <a class="btn btn-sm btn-primary" aria-label="Left Align" href="/?ctrl=admin&act=edit&id=<?php echo $item->id; ?>">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>
                <a class="btn btn-sm btn-danger" aria-label="Left Align" href="?ctrl=admin&act=delete&id=<?php echo $item->id; ?>">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </a>
            </div>
        </div>
    </div>

<?php endforeach; ?>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>