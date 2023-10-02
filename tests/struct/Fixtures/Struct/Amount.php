<?php

declare(strict_types=1);

namespace Struct\Struct\Tests\Fixtures\Struct;

use Struct\Struct\Contracts\StructInterface;

class Amount implements StructInterface
{
    public int $value = 200;
    public string $currency = 'EUR';
}
