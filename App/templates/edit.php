<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title; ?></title>

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
    <h1><?php echo $title; ?></h1>
    <br>

    <form class="form-horizontal" action="/Controllers/save.php" method="post">
        <div class="form-group">
            <label class="col-sm-2" for="title">Заголовок</label>
            <div class="col-sm-10">
              <input class="form-control" id="title" name="title" type="text" placeholder="Введите заголовок" value="<?php echo $news->title; ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2" for="author">Автор новости</label>
            <div class="col-sm-10">
                <input class="form-control none-indent" id="author" name="author"
                     type="text" placeholder="Введите автора"
                     <?php $str = ''; ?>
                     <?php if (isset($news->author_id) && !empty($news->author_id)) : ?>
                         <?php $str = $news->getAuthor($news->author_id); ?>
                     <?php endif; ?>
                     <?php $str = (false === $str) ? '' : $str; ?>
                     value="<?php echo $str; ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2" for="content">Текст</label>
            <div class="col-sm-10">
              <textarea class="form-control" id=content" name="content" cols="100" rows="10" placeholder="Введите текст" required><?php echo $news->content; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?php if ($news->id) { echo '<input type="hidden" name="id" value="' . $news->id .'">'; } ?>

                <input name="edit" type="submit" value="Сохранить">
            </div>
        </div>
    </form>

    <br>
    <a class="btn btn-success" href="/">На главную</a>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>