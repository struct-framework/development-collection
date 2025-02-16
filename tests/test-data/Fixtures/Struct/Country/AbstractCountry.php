<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct\Country;

use Struct\Contracts\StructInterface;

abstract class AbstractCountry implements StructInterface
{
    public string $name;
}
