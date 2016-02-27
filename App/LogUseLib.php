<?php

namespace App;

use Psr\Log\AbstractLogger;
use Psr\Log\LoggerTrait;

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

}