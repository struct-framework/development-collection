<?php

declare(strict_types=1);

namespace Struct\Exception;

class InvalidValueException extends DeserializeException
{
    public function __construct(int $code, string $message, string $example)
    {
        parent::__construct($code, $message . ' must lock like: ' . $example);
    }
}
