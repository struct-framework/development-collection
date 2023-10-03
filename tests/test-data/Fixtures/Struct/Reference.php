<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct;

use Struct\Attribute\ArrayList;
use Struct\Contracts\StructInterface;

class Reference implements StructInterface
{
    public string $title;
    /**
     * @var Technology[]|null
     */
    #[ArrayList(Technology::class)]
    public ?array $technologies = null;
}
