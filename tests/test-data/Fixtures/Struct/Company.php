<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct;

use DateTimeInterface;
use Struct\Attribute\ArrayKeyList;
use Struct\Attribute\ArrayList;
use Struct\Attribute\DefaultValue;
use Struct\Attribute\StructType;
use Struct\Contracts\StructCollection;
use Struct\Contracts\StructInterface;
use Struct\TestData\Fixtures\Struct\Enum\Category;

class Company implements StructInterface
{
    public string $name = '';

    #[DefaultValue('2022-05-05 00:00:00')]
    public DateTimeInterface $foundingDate;
    public Address $address;
    public bool $isActive;
    public Category $category;
    public Category $category2 = Category::Financial;

    /**
     * @var array<string, string>
     */
    #[ArrayKeyList('string')]
    public array $properties = [];

    /**
     * @var array<string>
     */
    #[ArrayList('string')]
    public array $tags = [];

    #[StructType(Tag::class)]
    public StructCollection $tagCollection;

    /**
     * @var Person[]
     */
    #[ArrayList(Person::class)]
    public array $persons = [];

    public int $age = 20;

    /**
     * @var Role[]
     */
    #[ArrayKeyList(Role::class)]
    public array $roles = [];

    public RoleCollection $roleCollection;

    public float $longitude;
    public float $latitude;

    /**
     * @var Reference[]
     */
    #[ArrayKeyList(Reference::class)]
    public array $references = [];

    public DataType $dataType;

    public Amount $amount;

    /**
     * @var array<string, mixed>
     */
    #[ArrayKeyList('mixed')]
    public array $arrayKeyMixed = [];

    /**
     * @var list<mixed>
     */
    #[ArrayList('mixed')]
    public array $arrayListMixed = [];

    public TestDataType $testDataType;
}
