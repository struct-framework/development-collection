<?php
declare(strict_types=1);

namespace Struct\DataType\Contracts;


interface DataTypeInterface extends \Stringable
{
    public function serializeToString(): string;

    public static function deserializeToString(string $serializedData): self;
}
