<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct;

use Struct\Contracts\StructInterface;
use Struct\Struct\Contracts\Attribute\ArrayList;

class Reference implements StructInterface
{
    public string $title;
    /**
     * @var Technology[]|null
     */
    #[ArrayList(Technology::class)]
    public ?array $technologies = null;
}
