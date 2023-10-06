<?php

declare(strict_types=1);

namespace Struct\Contracts\Serialize;

interface SerializableToString extends \Stringable
{
    public function serializeToString(): string;

    public function deserializeFromString(string $serializedData): void;
}
