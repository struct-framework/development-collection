<?php

declare(strict_types=1);

namespace Struct\Struct\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\Struct\Factory\StructFactory;
use Struct\Struct\StructHash;
use Struct\TestData\Fixtures\Struct\Query\TimeFilter;
use Struct\TestData\Fixtures\Struct\Query\TimeFilterType;
use Struct\TestData\Fixtures\Struct\Query\TimeQuery;

class StructHashTestQuery extends TestCase
{
    public function testQuery(): void
    {
        $timeQuery01 = StructFactory::create(TimeQuery::class);
        $timeQuery02 = StructFactory::create(TimeQuery::class);

        $filter1 = StructFactory::create(TimeFilter::class);
        $filter1->type = TimeFilterType::Project;
        $filter1->identifier = '1000';
        $filter1->label = 'p1000-general-expenses';
        $timeQuery01->filters[] = $filter1;

        $filter2 = StructFactory::create(TimeFilter::class);
        $filter2->type = TimeFilterType::Task;
        $filter2->identifier = '09f35824-7bcc-4b62-93f4-f4ec8c96c7ac';
        $filter2->label = '#35 Wochentelko';
        $timeQuery01->filters[] = $filter2;
        $timeQuery02->filters[] = $filter2;

        $this->assertHach($timeQuery01);
        $this->assertHach($timeQuery02);
    }

    protected function assertHach(TimeQuery $timeQuery): void
    {
        $timeQueryHash = StructHash::buildHash($timeQuery);
        $timeQueryHash = \bin2hex($timeQueryHash);
        self::assertSame('0d0f5e1035429ab64a9a97646a915675c633c3c6318768a91a06ce7deefd63d322ddbba2648c592b2bad797b658e44ee52c775b55cae64e306447009a7dcfbcd', $timeQueryHash);
    }
}
