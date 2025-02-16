<?php

declare(strict_types=1);

namespace Struct\Exception;

use RuntimeException;
use Throwable;

abstract class ServiceException extends RuntimeException
{
    public function __construct(int $code, string $message = '', ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
