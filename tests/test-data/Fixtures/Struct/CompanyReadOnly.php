<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct;

use DateTimeInterface;
use Struct\Attribute\DefaultValue;
use Struct\Contracts\StructInterface;

readonly class CompanyReadOnly implements StructInterface
{
    public function __construct(
        public string $name = '',
        #[DefaultValue('2022-05-05 00:00:00')]
        public DateTimeInterface $foundingDate,
    ) {
    }
}
