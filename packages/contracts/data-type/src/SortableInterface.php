<?php

declare(strict_types=1);

namespace Struct\DataType\Contracts;

interface SortableInterface
{
    public function getSortValue(): int;
}
