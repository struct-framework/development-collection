<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct;

use Struct\Contracts\StructInterface;

readonly class TagInt implements StructInterface
{
    public function __construct(
        public int $value,
    ) {
    }
}
