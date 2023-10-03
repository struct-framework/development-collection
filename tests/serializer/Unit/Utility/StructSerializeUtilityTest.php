<?php

declare(strict_types=1);

namespace Struct\Serializer\Tests\Unit\Utility;

use PHPUnit\Framework\TestCase;
use Struct\Contracts\StructInterface;
use Struct\Exception\InvalidStructException;
use Struct\Exception\InvalidValueException;
use Struct\Struct\Factory\StructFactory;
use Struct\TestData\Fixtures\Struct\Company;
use Struct\TestData\Fixtures\Struct\DataType;
use Struct\TestData\Fixtures\Struct\Wrong;
use Struct\TestData\Preparer\CompanyPreparer;
use Struct\TestData\Proxy\Utility\StructSerializeUtilityProxy;

class StructSerializeUtilityTest extends TestCase
{
    protected StructSerializeUtilityProxy $subject;
    protected Company $company;
    protected string $expectation;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = new StructSerializeUtilityProxy();
        $companyPreparer = new CompanyPreparer();
        $this->company = $companyPreparer->buildCompany();
        $this->expectation = (string) \file_get_contents(__DIR__ . '/../../../test-data/Expectation/Company.json');
        $this->expectation = \substr($this->expectation, 0, -1);
    }

    public function testDataType(): void
    {
        $dataType = StructFactory::create(DataType::class);

        self::assertInstanceOf(DataType::class, $dataType);
    }

    public function testFullSerialize(): void
    {
        $companyJson = $this->subject->serializeToJson($this->company);
        self::assertSame($this->expectation, $companyJson);
    }

    public function testFullUnSerialize(): void
    {
        $companyArrayExpectation = $this->subject->serialize($this->company);
        /** @var Company $companyUnSerialize */
        $companyUnSerialize = $this->subject->deserialize($companyArrayExpectation, Company::class);
        self::assertSame($this->company->name, $companyUnSerialize->name);
    }

    public function testInvalidValueException(): void
    {
        $wrong = new Wrong();
        $this->expectException(InvalidStructException::class);
        $this->subject->serialize($wrong);
    }

    public function testDeserializeFromJsonBadType(): StructInterface
    {
        $this->expectException(InvalidValueException::class);
        return $this->subject->deserializeFromJson($this->expectation, 'ImNotAnStructure');  // @phpstan-ignore-line
    }

    public function testDeserializeFromJson(): void
    {
        $company = $this->subject->deserializeFromJson($this->expectation, Company::class);
        self::assertInstanceOf(Company::class, $company);
    }

    public function testDeserializeObject(): void
    {
        $company = $this->subject->deserialize($this->company, Company::class);
        self::assertInstanceOf(Company::class, $company);
    }
}
