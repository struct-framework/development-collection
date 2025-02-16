<?php

declare(strict_types=1);

namespace Struct\Exception;

use Exception;
use Throwable;

abstract class LogicException extends Exception
{
    public function __construct(int $code, string $message = '', ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
