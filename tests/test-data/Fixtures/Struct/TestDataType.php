<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct;

use DataType\Contracts\DataTypeInterface;

final readonly class TestDataType implements DataTypeInterface
{

    public function __construct(
        public string $value
    )
    {}

    public function __toString(): string
    {
        return $this->value;
    }


    public function serializeToString(): string
    {
        return $this->value;
    }

}
