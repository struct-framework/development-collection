<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures;

use Struct\Contracts\StructInterface;

class PersonProperty implements StructInterface
{
    public function getName(): string
    {
        return 'Max';
    }

    protected function buildName(string $name): string|bool
    {
        return 'Max';
    }
}
