<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct;

use Struct\Contracts\StructInterface;

class Contact implements StructInterface
{
    public string $type = '';
    public string $value = '';
}
