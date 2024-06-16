<?php

declare(strict_types=1);

namespace Struct\Contracts;

interface SortableInterface
{
    public function getSortValue(): int|false;
}
