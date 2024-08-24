<?php

declare(strict_types=1);

namespace Struct\Struct\Tests\Unit\Helper;

use PHPUnit\Framework\TestCase;
use Struct\Struct\Private\Helper\PropertyReflectionHelper;
use Struct\TestData\Fixtures\Struct\Company;

class PropertyReflectionHelperTest extends TestCase
{

    public function testReadProperties(): void
    {
        $companyProperty = PropertyReflectionHelper::readProperties(Company::class);


        $r = 0;
    }
}
