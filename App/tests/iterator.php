<?php
/**
 * Подключение файла автозагрузки
 */

require_once __DIR__ . '/../../autoload.php';

$view = new \App\View();
$view->title = 'Админ-панель';
$view->content = 'Контент';
$view->authors = \App\Models\Author::findAll();

/*
foreach($view->authors as $key => $value) {
    echo gettype($value) . '<br>';

    if (!is_object($value) && !is_array($value)) {
        continue;
    }
    echo ++$key . '). ';
    $iter = new App\MyIterator($value);

    foreach ($iter as $k => $v) {
        if (!is_object($v) && !is_array($v)) {
            echo $k . ' = ' . $v . '; ';
            continue;
        }

        $iter2 = new App\MyIterator($v);

        foreach ($iter2 as $k2 => $v2) {
            echo $k2 . ' = ' . $v2 . '; ';
        }
    }
    echo '<br>';
}
*/
?>
<table class="table table-hover">
    <caption>Авторы</caption>
    <?php foreach($view->authors as $key => $value) : ?>
        <tr>
            <?php if (!is_object($value) && !is_array($value)) : ?>
                <?php continue; ?>
            <?php endif; ?>
            <td>
                <?php echo ++$key . '). '; ?>
            </td>
        <?php $iter = new App\MyIterator($value);

        foreach ($iter as $k => $v) :
            if (!is_object($v) && !is_array($v)) : ?>
                <td>
                    <?php echo $k . ' = ' . $v . '; '; ?>
                </td>
                <?php continue;
            endif;

            $iter2 = new App\MyIterator($v);

            foreach ($iter2 as $k2 => $v2) : ?>
            <td>
                <?php echo $k2 . ' = ' . $v2 . '; '; ?>
            </td>
            <?php endforeach; ?>
        <?php endforeach; ?>
        </tr>
<?php endforeach; ?>
</table>





