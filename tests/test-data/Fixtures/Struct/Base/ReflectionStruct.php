<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct\Base;

use Struct\Attribute\ArrayKeyList;
use Struct\Contracts\StructInterface;
use Struct\DataType\Amount;
use Struct\TestData\Fixtures\Struct\Company;
use Struct\TestData\Fixtures\Struct\Enum\Category;
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
    #[ArrayKeyList([Tag::class, 'string'])]
    public array $tags;

    public Category $category;
}
