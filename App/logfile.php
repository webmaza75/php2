alert | 26-02-2016 20:02:32 |Неверный адрес [uri]: /tfdjs/SDVDS; [ctrl]: \App\Controllers\tfdjs; [file]: D:\OpenServer\domains\php2.local\index.php; [line]: 27; [code]: 0; 
alert | 26-02-2016 20:02:48 |Несуществующий адрес [uri]: /admin/SDVDS; [ctrl]: \App\Controllers\admin; [act]: SDVDS; [file]: D:\OpenServer\domains\php2.local\index.php; [line]: 35; [code]: 0; 
alert | 26-02-2016 20:02:36 |Новость не найдена [file]: D:\OpenServer\domains\php2.local\App\Controllers\News.php; [line]: 28; [code]: 0;
alert | 26-02-2016 20:02:13 |Новость не найдена [file]: D:\OpenServer\domains\php2.local\App\Controllers\Admin.php; [line]: 43; [code]: 0; 
emergency | 26-02-2016 22:02:00 |Некорректные параметры подключения к БД [file]: D:\OpenServer\domains\php2.local\App\Db.php; [line]: 47; [code]: 0;
emergency | 26-02-2016 23:02:29 |Неверный запрос к БД [sql]: SELECT qqqqq FROM news;; [file]: D:\OpenServer\domains\php2.local\App\Db.php; [line]: 96; [code]: 0; 
emergency | 26-02-2016 23:02:12 |Неверный запрос к БД [sql]: SELECT * FROM authors WHERE `id`=::id;; [file]: D:\OpenServer\domains\php2.local\App\Db.php; [line]: 96; [code]: 0; 
emergency | 26-02-2016 23:02:31 |Неверный запрос к БД [sql]: 
            INSERT INTO news
            (title,,content,,author_id)
            VALUES
            (:title,:content,:author_id)
        ; [file]: D:\OpenServer\domains\php2.local\App\Db.php; [line]: 72; [code]: 0; 
emergency | 26-02-2016 23:02:29 |Неверный запрос к БД [sql]: INSERT INTO news SET title=:title, content=:content, author_id=:author_id WHERE id=:id;; [file]: D:\OpenServer\domains\php2.local\App\Db.php; [line]: 72; [code]: 0; 
alert | 27-02-2016 22:02:58 |Проверка данных: пустое поле заголовка [file]: D:\OpenServer\domains\php2.local\App\Models\News.php; [line]: 107; [code]: 0; 
alert | 27-02-2016 22:02:58 |Проверка данных: пустое поле текста новости [file]: D:\OpenServer\domains\php2.local\App\Models\News.php; [line]: 107; [code]: 0; 
alert | 27-02-2016 22:02:58 |Проверка данных: такой автор не существует [file]: D:\OpenServer\domains\php2.local\App\Models\News.php; [line]: 113; [code]: 0;
emergency | 28-02-2016 21:02:44 |Некорректные параметры подключения к БД. Администратор оповещен [file]: D:\OpenServer\domains\php2.local\App\Db.php; [line]: 50; [code]: 0; 
