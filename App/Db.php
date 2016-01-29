<?php


namespace App;


class Db
{
    protected $dbh;

    public function __construct()
    {
        $this->dbh = new \PDO('mysql:host=localhost;dbname=php2', 'root', '');
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
}