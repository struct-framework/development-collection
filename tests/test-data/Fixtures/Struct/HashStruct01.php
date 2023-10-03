<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct;

use Struct\Contracts\StructInterface;

class HashStruct01 implements StructInterface
{
    public string $firstName = 'Max';
    public string $lastName = 'Mustermann';
    public string $title = 'Dr.-';
}
