<?php

namespace App;

use App\Exceptions\MyException;
use Psr\Log\AbstractLogger;
use Psr\Log\LoggerTrait;

/**
 * Class LogUseLib использование внешнего пакета Psr/Log
 * @package App
 */
class LogUseLib extends AbstractLogger
{
    use LoggerTrait;
    const LOG_FILE = __DIR__ . '/logfile.php';

    public function log($level, $message, array $context = [])
    {
        $message = $level . date(' | d-m-Y H:m:s |') . $message;
        if (!empty($context)) {
            $message.= $this->toString($context);
        }
        $res = file_put_contents(self::LOG_FILE, $message, FILE_APPEND);
        return $res;
    }

    public function toString($context)
    {
        $cont = '';
        foreach ($context as $k => $v) {
            $cont .= ('[' . $k .']: ' . $v . '; ');
        }
        return $cont . "\n";
    }

    /**
     * Для мультиисключения
     * @param array $e
     * @var MyException $error
     */
    public function getArrMess($e)
    {
        foreach ($e as $error) {
            $this->alert($error->getMessage(), $error->getMess());
        }
    }
}