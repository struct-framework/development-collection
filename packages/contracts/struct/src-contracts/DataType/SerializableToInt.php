<?php

declare(strict_types=1);

namespace Struct\Contracts\DataType;

interface SerializableToInt
{
    public function serializeToInt(): int;
}
