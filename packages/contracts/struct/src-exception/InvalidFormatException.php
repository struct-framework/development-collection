<?php

declare(strict_types=1);

namespace Struct\Exception;

use LogicException;
use Throwable;

final class InvalidFormatException extends LogicException
{
    public function __construct(string $givenValue, string $expectedFormat, int $code, ?Throwable $previous = null)
    {
        $message = 'The format of <' . $givenValue . '> is incorrect, <' . $expectedFormat . '> expected';
        parent::__construct($message, $code, $previous);
    }
}
