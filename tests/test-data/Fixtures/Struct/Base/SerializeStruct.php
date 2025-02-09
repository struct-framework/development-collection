<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct\Base;


use Struct\Contracts\StructInterface;

class SerializeStruct implements StructInterface
{
    public string $name;
    public int $age;

    public ?int $ageNull = null;
}
