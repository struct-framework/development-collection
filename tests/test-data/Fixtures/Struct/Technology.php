<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct;

use Struct\Contracts\StructInterface;

readonly class Technology implements StructInterface
{
    public function __construct(
        public string $name,
        public ?string $country = null,
    ) {
    }
}
