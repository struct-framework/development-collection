<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct;

use DateTimeInterface;
use Struct\Attribute\ArrayKeyList;
use Struct\Attribute\ArrayList;
use Struct\Attribute\DefaultValue;
use Struct\Contracts\StructInterface;
use Struct\DataType\Date;
use Struct\TestData\Fixtures\Struct\Enum\Category;

class Company implements StructInterface
{
    public string $name = '';

    #[DefaultValue('2022-05-05 00:00:00')]
    public DateTimeInterface $foundingDate;
    public Address $address;
    public Category $category;
    public bool $isActive;
    public Category $category2 = Category::Financial;


    public Date $refactorDate;

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

    /**
     * @var array<Tag>
     */
    #[ArrayList(Tag::class)]
    public array $tagCollection = [];

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

    /**
     * @var array<Role>
     */
    #[ArrayList(Role::class)]
    public array $roleCollection = [];

    public float $longitude;
    public float $latitude;

    /**
     * @var Reference[]
     */
    #[ArrayKeyList(Reference::class)]
    public array $references = [];

    public DataType $dataTypeCollection;

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
}
