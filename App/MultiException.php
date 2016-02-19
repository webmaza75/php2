<?php
namespace App;
use App\Exceptions\MyException;

/**
 * Class MultiException
 * @package App
 */
class MultiException extends MyException
    implements \ArrayAccess, \Iterator
{
    use TCollection;
}