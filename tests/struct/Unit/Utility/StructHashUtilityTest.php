<?php

declare(strict_types=1);

namespace Struct\Struct\Tests\Unit\Utility;

use PHPUnit\Framework\TestCase;
use Struct\Struct\Utility\StructHashUtility;
use Struct\TestData\Fixtures\Struct\Company;
use Struct\TestData\Fixtures\Struct\HashStruct01;
use Struct\TestData\Fixtures\Struct\HashStruct02;
use Struct\TestData\Preparer\CompanyPreparer;

class StructHashUtilityTest extends TestCase
{
    protected StructHashUtility $subject;
    protected Company $company;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = new StructHashUtility();
        $companyPreparer = new CompanyPreparer();
        $this->company = $companyPreparer->buildCompany();
    }

    public function testBuildHash(): void
    {
        $companyHash = $this->subject->buildHash($this->company);
        self::assertSame('d3ab22f2679dae7952c978bd5f1bbd8ae8a08dd0e908f33282c11e210e4d1343c0346c2ab37d97c7199dac70179a2d7117f848caf3133cb256d246ec3983de92', bin2hex($companyHash));
    }

    public function testBuildHashStruct01(): void
    {
        $hashStruct01 = new HashStruct01();
        $hash = $this->subject->buildHash($hashStruct01);
        self::assertSame('810bf6af5f65252c15a890d40340d470d75508da72964ffcea3b5ce6f4a3e96cbc8661ffa6b5ec117681a67d71dbd047eb71fc4d3b7f2db7cb61a2696503e7e2', bin2hex($hash));
    }

    public function testBuildHashStruct02(): void
    {
        $hashStruct02 = new HashStruct02();
        $hash = $this->subject->buildHash($hashStruct02);
        self::assertSame('e34792d4f86206b0d13da9b10d0cb9e958a53deb9d4aa080cec92b4252e34241a85b6a7f25826dd8e836433f8aa7eef16e0a3c2d2df36748be87e932e9e2d191', bin2hex($hash));
    }
}
