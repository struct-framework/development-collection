<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct;

use Struct\Contracts\StructInterface;

class Address implements StructInterface
{
    public string $street = '';
    public string $houseNumber = '';
    public string $zip = '';
    public string $city = '';
}
