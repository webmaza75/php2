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
     * @var string DbName - для получения столбцов из таблиц БД полей,
     * которые заданы как Not Null (предполагается использовать в Model)
     */
    protected $dbh;
    protected static $DbName;

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

        self::$DbName = $config->data['db']['dbname'];

        $param2 = $config->data['db']['login'];
        $param3 = $config->data['db']['pass'];
        try {
            $this->dbh = new \PDO($param1, $param2, $param3);
            //Добавлены аттрибуты подключения (режимы выброса исключений)
            $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new \App\Exceptions\DB('Некорректные параметры подключения к БД');
        }
    }
    public function getDbName()
    {
        return self::$DbName;
    }

    /**
     * Метод выполнения запроса к БД на добавление|обновление|удаление записи об объекте
     * @param string $sql строка запроса
     * @param array $args массив подстановок в строку запроса
     * @return bool
     */
    public function execute($sql, $args = [])
    {
        try {
            $sth = $this->dbh->prepare($sql);

            if (!$args) { // если массив с параметрами для запроса пустой
                $res = $sth->execute();
            } else {
                $res = $sth->execute($args);
            }
        } catch (\PDOException $e) {
            throw new \App\Exceptions\DB('Неверный запрос к БД');
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
        try {
            $sth = $this->dbh->prepare($sql);
            if (!$args) { // если массив с параметрами для запроса пустой
                $res = $sth->execute();
            } else {
                $res = $sth->execute($args);
            }
        } catch (\PDOException $e) {
            throw new \App\Exceptions\DB('Неверный запрос к БД');
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