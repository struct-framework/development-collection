<?php

declare(strict_types=1);

namespace Struct\DataProcessing\ObjectType;

use Struct\Contracts\StructInterface;

abstract class EntityObject implements StructInterface
{
    public string $identifier;
}
