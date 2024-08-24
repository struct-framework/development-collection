<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures;

use DateTimeInterface;
use Struct\Attribute\ArrayKeyList;
use Struct\Attribute\ArrayList;
use Struct\Attribute\DefaultValue;
use Struct\Attribute\StructType;
use Struct\Contracts\DataTypeInterface;
use Struct\Contracts\StructCollection;
use Struct\Contracts\StructInterface;
use Struct\TestData\Fixtures\Struct\Address;
use Struct\TestData\Fixtures\Struct\Amount;
use Struct\TestData\Fixtures\Struct\DataType;
use Struct\TestData\Fixtures\Struct\Enum\Category;
use Struct\TestData\Fixtures\Struct\Person;
use Struct\TestData\Fixtures\Struct\Reference;
use Struct\TestData\Fixtures\Struct\Role;
use Struct\TestData\Fixtures\Struct\Tag;

class CompanyProperty implements StructInterface
{
    public function __construct(
        string $name,
        #[DefaultValue('2022-05-05 00:00:00')]
        public DateTimeInterface $foundingDate,
        public Address $address,
        public bool $isActive,
        public Category $category,
        #[ArrayKeyList('string')]
        public array $properties = [],
        public readonly string $test = 'Hello World!',
    ) {
    }

    public Category $category2 = Category::Financial;

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

    public int|float $longitude;
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

    public (StructInterface&DataTypeInterface)|int $intersectionType01;
    public StructInterface&DataTypeInterface $intersectionType02;

    private string $private;
    protected string $protected;

    public function getText(int $number): string
    {
        return 'Hello World!';
    }
}
