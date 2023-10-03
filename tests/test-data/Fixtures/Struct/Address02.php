<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct;

use Struct\Contracts\StructInterface;

class Address02 implements StructInterface
{
    public string $street = '';
    public string $zip = '';
    public string $city = '';
}
