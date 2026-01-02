<?php

declare(strict_types=1);

namespace Struct\DataType\Contracts\Exception;

use RuntimeException;
use Throwable;

class DeserializeException extends RuntimeException
{
    public function __construct(int $code, string $message, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
