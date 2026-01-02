<?php

declare(strict_types=1);

namespace Struct\DataType\Contracts;

interface SerializableToInt
{
    public function serializeToInt(): int;
}
