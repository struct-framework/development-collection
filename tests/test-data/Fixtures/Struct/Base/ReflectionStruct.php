<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct\Base;

use Struct\Attribute\ArrayList;
use Struct\Contracts\StructInterface;
use Struct\DataType\Amount;
use Struct\TestData\Fixtures\Struct\Company;
use Struct\TestData\Fixtures\Struct\Tag;

class ReflectionStruct implements StructInterface
{
    public string $name;
    public int $age;

    public ?int $ageNull = null;
    public int|string $turnover;
    public string|Company $company;

    public string|Amount $amount;

    /**
     * @var array<Tag>
     */
    #[ArrayList(Tag::class)]
    public array $tags;
}
