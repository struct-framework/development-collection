<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct;

use Struct\Contracts\StructCollection;

/**
 * @deprecated
 */
class RoleCollection extends StructCollection
{
    public function current(): Role
    {
        /** @var Role $item */
        $item = parent::current();
        return $item;
    }
}
