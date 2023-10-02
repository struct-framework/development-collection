<?php

declare(strict_types=1);

namespace Struct\Struct\Contracts;

interface DataTypeInterface
{
    public function serializeToString(): string;

    public static function deserializeToString(string $serializedData): self;
}
