<?php

declare(strict_types=1);

namespace Struct\Struct\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\Struct\StructHashUtility;
use Struct\TestData\Fixtures\Struct\Company;
use Struct\TestData\Fixtures\Struct\HashStruct01;
use Struct\TestData\Fixtures\Struct\HashStruct02;
use Struct\TestData\Preparer\CompanyPreparer;
use Struct\TestData\Preparer\StructCollectionPreparer;

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

    public function testBuildHashStruct01(): void
    {
        $hashStruct01 = new HashStruct01();
        $hash = StructHashUtility::buildHash($hashStruct01);
        self::assertSame('ab1b90f90ee361cb6c7da58e1e4aaca7c4b780236d30b2009abf124e2088948f', bin2hex($hash));
    }

    public function testBuildHashStruct02(): void
    {
        $hashStruct02 = new HashStruct02();
        $hash = StructHashUtility::buildHash($hashStruct02);
        self::assertSame('613b08c14114e46dea2e2b2f863e060f228cb52339a0d2f6adde21a3ec1d2a18', bin2hex($hash));
    }

    public function testBuildHashStructCollection(): void
    {
        $structCollectionPreparer = new StructCollectionPreparer();
        $structCollection = $structCollectionPreparer->buildStructCollection();
        $hash = StructHashUtility::buildHash($structCollection);
        self::assertSame('d5a0e86554e69afb4d2ae82048221dbbac7445499272a58840dde657415fad7c', bin2hex($hash));
    }
}
