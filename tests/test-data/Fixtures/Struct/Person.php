<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct;

use Struct\Contracts\StructInterface;
use Struct\Struct\Contracts\Attribute\ArrayKeyList;

class Person implements StructInterface
{
    public string $title = '';
    public string $firstName = '';
    public ?string $middleName = null;
    public string $lastName = '';

    /**
     * @var Contact[]
     */
    #[ArrayKeyList(Contact::class)]
    public array $contacts = [];
}
