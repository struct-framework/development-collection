<?php

namespace Z3\UnifiedModel;

namespace Struct\DataProcessing\Internal;

use Struct\DataProcessing\ObjectType\EntityObject;
use Struct\DataProcessing\ObjectType\ValueObject;

class ObjectCollection implements \Iterator, \Countable
{
    private int $currentIndex = 0;

    /**
     * @param array<string> $identifiers
     */
    public function __construct(
        protected readonly Well $well,
        protected array $identifiers = [],
    ) {
    }
    /**
     * @return array<EntityObject|ValueObject>
     */
    public function getValues(): array
    {
        $values = [];
        foreach ($this->identifiers as $identifier) {
            $values[] = $this->well->get($identifier);
        }
        return $values;
    }

    public function addValue(EntityObject|ValueObject $object): void
    {
        $identifier = $this->well->add($object);
        $this->identifiers[] = $identifier;
    }

    public function count(): int
    {
        return count($this->identifiers);
    }

    public function current(): EntityObject|ValueObject
    {
        $identifier = $this->identifiers[$this->currentIndex];
        return $this->well->get($identifier);
    }

    public function next(): void
    {
        ++$this->currentIndex;
    }

    public function key(): int
    {
        return $this->currentIndex;
    }

    public function valid(): bool
    {
        if ($this->currentIndex < count($this->identifiers)) {
            return true;
        }
        return false;
    }
    public function rewind(): void
    {
        $this->currentIndex = 0;
    }

    public function getRawIdentifiers(): array
    {
        return $this->identifiers;
    }
}
