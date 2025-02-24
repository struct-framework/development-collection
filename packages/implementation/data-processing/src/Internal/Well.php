<?php

declare(strict_types=1);

namespace Struct\DataProcessing\Internal;

use Struct\DataProcessing\Helper\ObjectHelper;
use Struct\DataProcessing\ObjectType\EntityObject;
use Struct\DataProcessing\ObjectType\ReferenceObject;
use Struct\DataProcessing\ObjectType\ValueObject;

/**
 * @internal
 */
final class Well
{
    /**
     * @var array<string, EntityObject|ValueObject>
     */
    protected array $storage = [];

    public function add(EntityObject|ValueObject|ReferenceObject $object): string
    {
        $identifier = ObjectHelper::readIdentifier($object);
        if ($object instanceof ReferenceObject) {
            return $identifier;
        }
        $this->storage[$identifier] = $object;
        return $identifier;
    }

    public function has(string $identifier): bool
    {
        return \array_key_exists($identifier, $this->storage);
    }

    public function get(string $identifier): EntityObject|ValueObject
    {
        return  $this->storage[$identifier];
    }
}
