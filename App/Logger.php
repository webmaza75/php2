<?php

namespace App;

/**
 * Class Logger
 * @package App
 * const string LOG_FILE
 */
class Logger
{
    const LOG_FILE = __DIR__ . '/log.php';

    /**
     * @param $content
     * @property \App\Exceptions\MyException $error
     * @return int
     */
    public static function putContent($content)
    {
        $content = date('d-m-Y H:m:s |') . $content;
        $res = file_put_contents(self::LOG_FILE, $content, FILE_APPEND);
        return $res;
    }

    public static function putArrContent($errors)
    {
        foreach ($errors as $error) {
            self::putContent($error->getMess());
        }
    }

}