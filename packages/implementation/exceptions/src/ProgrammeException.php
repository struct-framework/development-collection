<?php

declare(strict_types=1);

namespace Struct\Exceptions;


class ProgrammeException extends \Exception
{
    public function __construct(int $code, string $message, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
