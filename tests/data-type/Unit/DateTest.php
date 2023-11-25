<?php

declare(strict_types=1);

namespace Struct\DataType\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\DataType\Date;

class DateTest extends TestCase
{
    public function testSerializeToString(): void
    {
        $date = new Date();
        $date->setYear(2023);
        $date->setMonth(8);
        $date->setDay(15);
        $serializedMonth = $date->serializeToString();
        self::assertSame('2023-08-15', $serializedMonth);
    }

    public function testDeserializeToString(): void
    {
        $serializedMonth = '2023-08-15';
        $date = new Date();
        $date->deserializeFromString($serializedMonth);
        self::assertSame(2023, $date->getYear());
        self::assertSame(8, $date->getMonth());
        self::assertSame(15, $date->getDay());
    }

    public function testDayCheck(): void
    {
        $date = new Date();
        $date->setYear(2023);
        $date->setMonth(2);
        self::expectExceptionCode(1696334057);
        $date->setDay(30);
    }

    public function testSerializeToInt(): void
    {
        $firstDate = new Date('1000-01-01');
        self::assertSame(0, $firstDate->serializeToInt());
    }

    public function testSerializeAll(): void
    {
        $startDateTime = new \DateTime('1000-01-01 00:00:00', new \DateTimeZone('UTC'));
        $startDayNumber = 0;
        $endDayNumber   = 3287181;

        $dateString = '';
        for ($expectedDayNumber = $startDayNumber; $expectedDayNumber <= $endDayNumber; $expectedDayNumber++) {
            $dateString = $startDateTime->format('Y-m-d');
            $date = new Date($dateString);
            $dateAsDayNumber = $date->serializeToInt();
            $dateDeserialized = new Date('9999-12-31');
            $dateDeserialized->deserializeFromInt($dateAsDayNumber);

            self::assertSame($expectedDayNumber, $dateAsDayNumber, $dateString);
            self::assertSame($dateString, $dateDeserialized->serializeToString(), $dateString);

            $startDateTime->modify('+1 day');
        }
        echo $dateString . PHP_EOL;
    }

    public function testDeserializeFromInt01(): void
    {
        $dateString = '1004-12-31';
        $date = new Date($dateString);
        $dateAsInt = $date->serializeToInt();
        $dateDeserialized = new Date('9999-12-31');
        $dateDeserialized->deserializeFromInt($dateAsInt);
        self::assertSame($dateString, $dateDeserialized->serializeToString(), $dateString);
    }

    public function testCalculateYearByDaysLabYear(): void
    {
        $date01 = new Date('1004-12-31');
        self::assertSame(1825, $date01->serializeToInt());
        $year01 = Date::calculateYearByDays(1825);
        self::assertSame(1004, $year01);

        $date02 = new Date('1005-01-01');
        self::assertSame(1826, $date02->serializeToInt());
        $year02 = Date::calculateYearByDays(1826);
        self::assertSame(1005, $year02);
    }

    public function testCalculateYearByDaysFourHundred(): void
    {
        $date01 = new Date('1200-12-31');
        self::assertSame(73413, $date01->serializeToInt());
        $year01 = Date::calculateYearByDays(73413);
        self::assertSame(1200, $year01);

        $date02 = new Date('1201-01-01');
        self::assertSame(73414, $date02->serializeToInt());
        $year02 = Date::calculateYearByDays(73414);
        self::assertSame(1201, $year02);
    }

    public function testCalculateYearByDays(): void
    {
        for ($year = 1000; $year <= 9999; $year++) {
            $days = Date::calculateDaysByYear($year);
            $yearResult = Date::calculateYearByDays($days);
            self::assertSame($year, $yearResult);
        }
    }
}
