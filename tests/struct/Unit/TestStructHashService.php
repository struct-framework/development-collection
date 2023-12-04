<?php

declare(strict_types=1);

namespace Struct\Struct\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\Contracts\StructInterface;
use Struct\Struct\Factory\StructFactory;
use Struct\Struct\StructHashUtility;
use Struct\TestData\Fixtures\Struct\Query\TimeFilter;
use Struct\TestData\Fixtures\Struct\Query\TimeFilterType;
use Struct\TestData\Fixtures\Struct\Query\TimeQuery;
use Struct\TestData\Preparer\CompanyPreparer;

class TestStructHashService extends TestCase
{
    public function testCompany(): void
    {
        $companyPreparer = new CompanyPreparer();
        $company = $companyPreparer->buildCompany();
        $this->assertHash($company, 'f3c49cf084a864c3fd4b730a8145a1dc6a11c2cb5adbb98065d0df8e7e66dd54');
    }

    public function testQuery(): void
    {
        $timeQuery01 = StructFactory::create(TimeQuery::class);
        $timeQuery02 = StructFactory::create(TimeQuery::class);

        $filter1 = StructFactory::create(TimeFilter::class);
        $filter1->type = TimeFilterType::Project;
        $filter1->identifier = '1000';
        $filter1->label = 'p1000-general-expenses';

        $filter2 = StructFactory::create(TimeFilter::class);
        $filter2->type = TimeFilterType::Task;
        $filter2->identifier = '09f35824-7bcc-4b62-93f4-f4ec8c96c7ac';
        $filter2->label = '#35 Wochentelko';

        $timeQuery01->filters[] = $filter1;
        $timeQuery01->filters[] = $filter2;
        $timeQuery02->filters[] = $filter2;

        $this->assertHash($timeQuery01, '58b7b5b6bc2404ad11187ca541f376176fb061ff5a1682786f5a53d2f01a9477');
        $this->assertHash($timeQuery02, 'f559abd5d71085d5a6bfc1d6fc660ab0cb3a2fdc15cd047704ccca555d5e71ee');
    }

    protected function assertHash(StructInterface $timeQuery, string $expected): void
    {
        $timeQueryHash = StructHashUtility::buildHash($timeQuery);
        $timeQueryHash = \bin2hex($timeQueryHash);
        self::assertSame($expected, $timeQueryHash);
    }
}
