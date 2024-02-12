<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct;

use DateTimeInterface;
use Struct\Contracts\StructInterface;

class Company02 implements StructInterface
{
    public string $name;
    public DateTimeInterface $foundingDate;
    public Address02 $address;
    public bool $isActive;
    public float $longitude;
    public float $latitude;
}
