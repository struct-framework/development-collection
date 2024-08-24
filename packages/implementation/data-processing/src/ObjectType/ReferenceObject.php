<?php

declare(strict_types=1);

namespace Struct\DataProcessing\ObjectType;

use Struct\Contracts\StructInterface;

final readonly class ReferenceObject implements StructInterface
{
    public function __construct(
        public string $type,
        public string $identifier,
    ) {
    }
}
