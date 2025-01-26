<?php

declare(strict_types=1);

namespace Struct\Struct\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\Struct\StructHashUtility;
use Struct\TestData\Fixtures\Struct\Company;
use Struct\TestData\Preparer\CompanyPreparer;

class StructHashUtilityTest extends TestCase
{
    protected Company $company;

    protected function setUp(): void
    {
        parent::setUp();
        $companyPreparer = new CompanyPreparer();
        $this->company = $companyPreparer->buildCompany();
    }

    public function testBuildHash(): void
    {
        $companyHash = StructHashUtility::buildHash($this->company);
        self::assertSame('7c203a1856e25953dd0565a209505834effb8786a2d900fcb0bf058edff1260b', bin2hex($companyHash));
    }
}
