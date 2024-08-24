<?php

declare(strict_types=1);

namespace Struct\dataProcessing\Tests\Unit\Helper;

use PHPUnit\Framework\TestCase;
use Struct\DataProcessing\Helper\DataHelper;
use Struct\DataType\Amount;
use Struct\DataType\Date;
use Struct\DataType\Enum\AmountVolume;
use Struct\DataType\Month;
use Struct\TestData\Fixtures\Struct\Enum\Category;
use Struct\TestData\Fixtures\Struct\Enum\Type;

class DataHelperTest extends TestCase
{
    public function testTransformToString(): void
    {
        $value = new \DateTime('2021-01-01 12:15:14', new \DateTimeZone('UTC'));
        self::assertSame('2021-01-01T12:15:14+00:00', DataHelper::toString($value));
        self::assertSame('dateTime', DataHelper::readPrefix($value));
        self::assertSame('dateTime:2021-01-01T12:15:14+00:00', DataHelper::toFullyQualifiedString($value));

        $value = new Date('2021-10-12');
        self::assertSame('2021-10-12', DataHelper::toString($value));
        self::assertSame('Date', DataHelper::readPrefix($value));
        self::assertSame('Date:2021-10-12', DataHelper::toFullyQualifiedString($value));

        $value = true;
        self::assertSame('true', DataHelper::toString($value));
        self::assertSame('bool', DataHelper::readPrefix($value));
        self::assertSame('bool:true', DataHelper::toFullyQualifiedString($value));

        $value = false;
        self::assertSame('false', DataHelper::toString($value));
        self::assertSame('bool', DataHelper::readPrefix($value));
        self::assertSame('bool:false', DataHelper::toFullyQualifiedString($value));


        $value = null;
        self::assertSame('null', DataHelper::toString($value));
        self::assertSame('null', DataHelper::readPrefix($value));
        self::assertSame('null:null', DataHelper::toFullyQualifiedString($value));


        $value = 'Hello World!';
        self::assertSame('Hello World!', DataHelper::toString($value));
        self::assertSame('string', DataHelper::readPrefix($value));
        self::assertSame('string:Hello World!', DataHelper::toFullyQualifiedString($value));

        $value = 3;
        self::assertSame('3', DataHelper::toString($value));
        self::assertSame('int', DataHelper::readPrefix($value));
        self::assertSame('int:3', DataHelper::toFullyQualifiedString($value));

        $value = 3.0;
        self::assertSame('3',  DataHelper::toString($value));
        self::assertSame('float', DataHelper::readPrefix($value));
        self::assertSame('float:3', DataHelper::toFullyQualifiedString($value));

        $value = Category::Financial;
        self::assertSame('cat-financial',  DataHelper::toString($value));
        self::assertSame('Struct\TestData\Fixtures\Struct\Enum\Category', DataHelper::readPrefix($value));
        self::assertSame('Struct\TestData\Fixtures\Struct\Enum\Category:cat-financial', DataHelper::toFullyQualifiedString($value));

        $value = Type::Hot;
        self::assertSame('Hot',  DataHelper::toString($value));
        self::assertSame('Struct\TestData\Fixtures\Struct\Enum\Type', DataHelper::readPrefix($value));
        self::assertSame('Struct\TestData\Fixtures\Struct\Enum\Type:Hot', DataHelper::toFullyQualifiedString($value));
    }


}
