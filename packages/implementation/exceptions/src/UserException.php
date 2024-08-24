<?php

declare(strict_types=1);

namespace Struct\Exceptions;


class UserException extends \RuntimeException
{

    public function __construct(int $code, string $message, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
