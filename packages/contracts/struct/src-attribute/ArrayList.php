<?php

declare(strict_types=1);

namespace Struct\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class ArrayList
{
    /**
     * @param string|array<string> $dataTypes
     */
    public function __construct(string|array $dataTypes)
    {
    }
}
