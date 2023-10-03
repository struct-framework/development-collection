<?php

declare(strict_types=1);

namespace Struct\Contracts\DataType;

use Struct\Contracts\Serialize\SerializableToString;

interface DataTypeInterface extends SerializableToString
{
    public static function deserializeFromString(string $serializedData): self;
}
