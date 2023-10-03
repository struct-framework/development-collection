<?php

declare(strict_types=1);

namespace Struct\Contracts\Serialize;

interface SerializableToString extends \Stringable
{
    public function serializeToString(): string;

    public static function deserializeFromString(string $serializedData): self;
}
