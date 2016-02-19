<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Все новости</title>

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
    <h1>Просмотр новости</h1><br>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">
                    <?php if (!empty($news->title)) : ?>
                        <?php echo $news->title; ?>
                    <?php else : ?>
                        -= Без заголовка =-
                    <?php endif; ?>
            </h3>
        </div>
        <div class="panel-body">
            <small>Автор:
                <?php if (!empty($news->author)) : ?>
                    <?php echo $news->author->name; ?>
                <?php else : ?>
                    не указан
                <?php endif; ?>
            </small>
            <div>
                <?php echo $news->content; ?>
            </div>
        </div>
    </div>
    <a class="btn btn-success" href="/">На главную</a>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>