<?php


namespace App;

use App;

/**
 * Class Db класс подключения к БД
 * @package App
 */
class Db
{
    /**
     * Использование трейта Singleton для поддержания единственного соединения с БД
     */
    use Singleton;

    /**
     * @var \PDO - объект PDO, предоставляющий соединение с БД
     */
    protected $dbh;

    /**
     * Создание объекта подключения к БД
     */
    public function __construct()
    {
        $config = App\Config::instance();

        $param1 = 'mysql:host=' .
            $config->data['db']['host'] .
            ';dbname=' .
            $config->data['db']['dbname'];

        $param2 = $config->data['db']['login'];
        $param3 = $config->data['db']['pass'];

        $this->dbh = new \PDO($param1, $param2, $param3);
    }

    /**
     * Метод выполнения запроса к БД на добавление|обновление|удаление записи об объекте
     * @param string $sql строка запроса
     * @param array $args массив подстановок в строку запроса
     * @return bool
     */
    public function execute($sql, $args = [])
    {
        $sth = $this->dbh->prepare($sql);
        if (!$args) { // если массив с параметрами для запроса пустой
            $res = $sth->execute();
        } else {
            $res = $sth->execute($args);
        }
        return $res;
    }

    /**
     * Метод выполнения запроса на получение данных из БД
     * @param string $class имя класса, к которому приводится объект из результирующего набор данных
     * @param string $sql строка запроса к БД
     * @param array $args массив подстановок для подготовленного запроса
     * @return array
     */
    public function query($class, $sql, $args = [])
    {
        $sth = $this->dbh->prepare($sql);
        if (!$args) { // если массив с параметрами для запроса пустой
            $res = $sth->execute();
        } else {
            $res = $sth->execute($args);
        }

        if(false !== $res) {
            // Возвращается масисв с объектом|объектами нужного класса
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
        return [];
    }

    /**
     * Получаем id последней вставленной в БД записи
     * @return string
     */
    public function lastInsId()
    {
        return $this->dbh->lastInsertId();
    }
}