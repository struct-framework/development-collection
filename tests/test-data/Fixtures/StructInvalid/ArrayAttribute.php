<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\StructInvalid;

use Struct\Attribute\ArrayList;
use Struct\Contracts\StructInterface;

class ArrayAttribute implements StructInterface
{
    #[ArrayList('string')]
    public array $names = [];

    public array $tags = [];
}
