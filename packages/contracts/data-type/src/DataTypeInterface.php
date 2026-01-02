<?php

declare(strict_types=1);

namespace Struct\DataType\Contracts;

use Stringable;
use Struct\Exception\DeserializeException;

interface DataTypeInterface extends Stringable
{
    /**
     * @throws DeserializeException
     */
    public function __construct(string $serializedString);
    public function serializeToString(): string;
}
