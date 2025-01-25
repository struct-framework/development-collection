<?php

declare(strict_types=1);

namespace Struct\Contracts\DataType;

interface SortableInterface
{
    public function getSortValue(): int|false;
}
