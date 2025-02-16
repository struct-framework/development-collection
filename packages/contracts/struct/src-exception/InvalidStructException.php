<?php

declare(strict_types=1);

namespace Struct\Exception;

use LogicException;
use Throwable;

/**
 * @deprecated
 */
final class InvalidStructException extends LogicException
{
    public function __construct(int $code, string $message, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
