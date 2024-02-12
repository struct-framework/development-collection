<?php

declare(strict_types=1);

namespace Struct\Contracts;

use Countable;
use Iterator;

interface StructCollectionInterface extends Countable, Iterator
{
    /**
     * @return array<StructInterface>
     */
    public function getValues(): array;
    public function addValue(StructInterface $struct): void;
    public function current(): StructInterface;
}
