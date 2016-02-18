<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Редактирование новости</title>

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
    <?php if ($errors) : ?>
    <?php foreach ($errors as $error): ?>
        <div class="alert alert-danger">
            <?php echo $error->getMessage(); ?>
        </div>
    <?php endforeach; ?>
    <?php endif; ?>

    <h1>Редактирование новости</h1>
    <br>

   <!-- <form class="form-horizontal" action="/?ctrl=Admin&act=Save" method="post">-->
    <form class="form-horizontal" action="/admin/save" method="post">
        <div class="form-group">
            <label class="col-sm-2" for="title">Заголовок</label>
            <div class="col-sm-10">
              <input class="form-control" id="title" name="title" type="text" placeholder="Введите заголовок" value="<?php echo $news->title; ?>" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2" for="author">Автор новости</label>
            <div class="col-sm-10">
                <input class="form-control none-indent" id="author" name="author"
                     type="text" placeholder="Введите автора"
                     <?php $str = (empty($news->author)) ? '' : $news->author->name; ?>
                     value="<?php echo $str; ?>">
                <input type="hidden" id="author_id" name="author_id" value="<?php echo $news->author_id; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2" for="content">Текст</label>
            <div class="col-sm-10">
              <textarea class="form-control" id=content" name="content" cols="100" rows="10" placeholder="Введите текст" ><?php echo $news->content; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?php if ($news->id) { echo '<input type="hidden" name="id" value="' . $news->id .'">'; } ?>

                <input type="submit" value="Сохранить">
            </div>
        </div>
    </form>

    <br>
    <!--<a class="btn btn-success" href="/?ctrl=Admin">На главную</a>-->
    <a class="btn btn-success" href="/admin/index">На главную</a>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>