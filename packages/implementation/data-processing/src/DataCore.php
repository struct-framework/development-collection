<?php

declare(strict_types=1);

namespace Struct\DataProcessing;

use Struct\DataProcessing\Internal\ObjectCollection;
use Struct\DataProcessing\Internal\Well;
use Struct\DataProcessing\ObjectType\EntityObject;
use Struct\DataProcessing\ObjectType\ReferenceObject;
use Struct\DataProcessing\ObjectType\ValueObject;

final readonly class DataCore
{
    public function __construct(
        protected Well $well
    ) {
    }

    /**
     * @param array<string> $identifiers
     */
    protected function buildObjectCollection(array $identifiers = []): ObjectCollection
    {
        $objectCollection = new ObjectCollection($this->well, $identifiers);
        return $objectCollection;
    }

    protected function buildReferenceObject(EntityObject|ValueObject $object): ReferenceObject
    {
        $identifier = $this->well->add($object);
        $referenceObject = new ReferenceObject(
            $object::class,
            $identifier,
        );
        return $referenceObject;
    }

    protected function readOriginalObject(ReferenceObject $referenceObject): EntityObject|ValueObject
    {
        $object = $this->well->get($referenceObject->identifier);
        return $object;
    }
}
