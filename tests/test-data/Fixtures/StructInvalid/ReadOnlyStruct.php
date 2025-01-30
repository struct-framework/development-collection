<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\StructInvalid;

use Struct\Contracts\StructInterface;

readonly class ReadOnlyStruct implements StructInterface
{
    public string $name; // @phpstan-ignore property.uninitializedReadonly
}
