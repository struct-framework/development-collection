<?php

declare(strict_types=1);

namespace Struct\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class DefaultValue
{
    // @phpstan-ignore-next-line
    public function __construct(string $value)
    {
    }
}
