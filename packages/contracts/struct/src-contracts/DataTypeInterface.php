<?php

declare(strict_types=1);

namespace Struct\Contracts;

use Struct\Contracts\DataType\SerializableToString;
use Struct\Exception\DeserializeException;

interface DataTypeInterface extends SerializableToString
{
    /**
     * @throws DeserializeException
     */
    public function __construct(string $serializedString);
}
