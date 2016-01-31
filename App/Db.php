<?php


namespace App;

use App;
//use \PDO;


class Db
{
    // Добавлено использование трейта Singleton
    use Singleton;

    protected $dbh;

    // Используются параметры подключения
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

    public function query($class, $sql, $args = [])
    {
        $sth = $this->dbh->prepare($sql);
        if (!$args) { // если массив с параметрами для запроса пустой
            $res = $sth->execute();
        } else {
            $res = $sth->execute($args);
        }

        if(false !== $res) {
            // Возвращается объект нужного класса
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
        return [];
    }

    // Получаем id последней вставленной в БД записи
    public function lastInsId()
    {
        return $this->dbh->lastInsertId();
    }
}