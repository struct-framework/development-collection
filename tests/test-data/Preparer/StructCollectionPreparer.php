<?php

declare(strict_types=1);

namespace Struct\TestData\Preparer;

use Struct\Contracts\StructCollection;
use Struct\TestData\Fixtures\Struct\Role;
use Struct\TestData\Fixtures\Struct\RoleCollection;

class StructCollectionPreparer
{
    public function buildStructCollection(): RoleCollection
    {
        $roleCollection = new RoleCollection();
        $role01 = new Role();
        $role01->name = "Hi I'am roll 1";
        $role02 = new Role();
        $role02->name = "Hi I'am roll 2";
        $roleCollection->addValue($role01);
        $roleCollection->addValue($role02);
        return $roleCollection;
    }

    public function buildDefaultStructCollection(): StructCollection
    {
        $roleCollection = new StructCollection();
        $role01 = new Role();
        $role01->name = "Hi I'am roll 1";
        $role02 = new Role();
        $role02->name = "Hi I'am roll 2";
        $roleCollection->addValue($role01);
        $roleCollection->addValue($role02);
        return $roleCollection;
    }
}
