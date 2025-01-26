<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\StructInvalid;

use Struct\Contracts\StructInterface;

class WithMethod implements StructInterface
{
    public string $name = '';

    public function notAllowedMethod(string $name): void
    {
    }
}
