<?php

namespace Laraflow\Cart\Exceptions;

use Exception;
use Throwable;

/**
 * Class CartException
 */
class CartException extends Exception
{
    /**
     * CoreException constructor.
     *
     * @param  string  $message
     * @param  int  $code
     */
    public function __construct($message = '', $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
