<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct\Query;

use Struct\Attribute\ArrayList;
use Struct\Contracts\StructInterface;

class TimeQuery implements StructInterface
{
    public Period $period;

    /**
     * @var array<TimeFilter>
     */
    #[ArrayList(TimeFilter::class)]
    public array $filters = [];
}
