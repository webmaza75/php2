<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Список новостей</title>
</head>
<body>

<?php foreach ($news as $item): ?>
    <div>
        <h1>
            <a href="../../../article.php?id=<?php echo $item->id; ?>">
                <?php echo $item->title; ?>
            </a>
        </h1>
        <div><?php echo $item->content; ?></div>
    </div>
<?php endforeach; ?>

</body>
</html>