<?php

declare(strict_types=1);

namespace Struct\DataProcessing\ObjectType;

use Struct\Contracts\DataTypeInterfaceWritable;
use Struct\Contracts\StructInterface;

final readonly class Property implements StructInterface
{
    public function __construct(
        public string                                                         $typeIdentifier,
        public string                                                         $typeLabel,
        public string                                                         $valueIdentifier,
        public string|int|float|bool|null|DataTypeInterfaceWritable|\UnitEnum $value,
        public ?string                                                        $typeShortIdentifier = null,
        public ?string                                                        $valueShortIdentifier = null,
    ) {
    }
}
