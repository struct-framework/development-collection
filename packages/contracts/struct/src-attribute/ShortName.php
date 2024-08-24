<?php

declare(strict_types=1);

namespace Struct\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class ShortName
{
    public function __construct(string $name)
    {
    }
}
