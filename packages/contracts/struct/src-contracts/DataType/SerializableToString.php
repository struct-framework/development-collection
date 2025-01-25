<?php

declare(strict_types=1);

namespace Struct\Contracts\DataType;

use Stringable;

interface SerializableToString extends Stringable
{
    public function serializeToString(): string;
}
