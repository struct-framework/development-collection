<?php

declare(strict_types=1);

namespace Struct\Contracts\Serialize;

interface SerializableToInt
{
    public function serializeToInt(): int;

    public function deserializeFromInt(int $serializedData): void;
}
