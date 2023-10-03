<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct;

use Struct\Contracts\StructInterface;

class Client implements StructInterface
{
    public string $name;
    public Address $invoiceAddress;
    public ?Address $deliveryAddress;
}
