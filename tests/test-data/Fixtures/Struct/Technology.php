<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct;

use Struct\Contracts\StructInterface;

class Technology implements StructInterface
{
    public string $name;
    public ?string $country = null;
}
