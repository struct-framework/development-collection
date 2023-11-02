<?php

declare(strict_types=1);

namespace Struct\Contracts;

interface StructCollectionInterface extends \Countable, \Iterator
{
    /**
     * @return array<StructInterface>
     */
    public function getValues(): array;
    public function addValue(StructInterface $struct): void;
}
