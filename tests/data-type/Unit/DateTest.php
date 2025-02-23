<?php

declare(strict_types=1);

namespace Struct\DataType\Tests\Unit;

use DateTime;
use PHPUnit\Framework\TestCase;
use Struct\DataType\Date;
use Struct\DataType\Enum\Weekday;

class DateTest extends TestCase
{
    public function testSerializeToString(): void
    {
        $date = new Date('2023-08-15');
        $serializedMonth = $date->serializeToString();
        self::assertSame('2023-08-15', $serializedMonth);
    }

    public function testSerializeToStringDateTime(): void
    {
        $date = new Date(new DateTime('2023-08-15 00:00:00'));
        $serializedMonth = $date->serializeToString();
        self::assertSame('2023-08-15', $serializedMonth);
    }

    public function testSerializeToStringInt(): void
    {
        $date = new Date(373869);
        $serializedMonth = $date->serializeToString();
        self::assertSame('2023-08-15', $serializedMonth);
    }

    public function testDeserializeToString(): void
    {
        $serializedMonth = '2023-08-15';
        $date = new Date($serializedMonth);
        self::assertSame(2023, $date->year);
        self::assertSame(8, $date->month);
        self::assertSame(15, $date->day);
    }

    public function testSerializeToInt(): void
    {
        $firstDate = new Date('1000-01-01');
        self::assertSame(0, $firstDate->serializeToInt());
    }

    public function testDayCheck(): void
    {
        self::expectExceptionCode(1737815642);
        new Date('2023-02-30');
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

    public function testWeekday(): void
    {
        $date01 = new Date('2023-11-25');
        self::assertSame(Weekday::Saturday, $date01->weekday());

        $date02 = new Date('2021-10-06');
        self::assertSame(Weekday::Wednesday, $date02->weekday());

        $date03 = new Date('1701-11-25');
        self::assertSame(Weekday::Friday, $date03->weekday());

        $date04 = new Date('3654-02-14');
        self::assertSame(Weekday::Saturday, $date04->weekday());
    }

    public function testCalendarWeek(): void
    {
        $date = new Date('2025-12-29');
        self::assertSame(1, $date->calendarWeek(), $date->serializeToString());

        $date = new Date('2020-12-29');
        self::assertSame(53, $date->calendarWeek(), $date->serializeToString());

        $date = new Date('2025-12-28');
        self::assertSame(52, $date->calendarWeek(), $date->serializeToString());

        $date = new Date('2025-12-31');
        self::assertSame(1, $date->calendarWeek(), $date->serializeToString());

        $date = new Date('2026-01-01');
        self::assertSame(1, $date->calendarWeek(), $date->serializeToString());

        $date = new Date('2020-12-31');
        self::assertSame(53, $date->calendarWeek(), $date->serializeToString());

        $date = new Date('2021-01-01');
        self::assertSame(53, $date->calendarWeek(), $date->serializeToString());

        $date = new Date('2023-01-01');
        self::assertSame(52, $date->calendarWeek(), $date->serializeToString());

        $date = new Date('2024-01-01');
        self::assertSame(1, $date->calendarWeek(), $date->serializeToString());

        $date = new Date('2023-06-04');
        self::assertSame(22, $date->calendarWeek(), $date->serializeToString());

        $date = new Date('2023-06-05');
        self::assertSame(23, $date->calendarWeek(), $date->serializeToString());

        $date = new Date('2023-06-11');
        self::assertSame(23, $date->calendarWeek(), $date->serializeToString());

        $date = new Date('2023-06-12');
        self::assertSame(24, $date->calendarWeek(), $date->serializeToString());
    }

    public function testSerializeAll(): void
    {
        $startDateTime = new DateTime('1000-01-01 00:00:00', new \DateTimeZone('UTC'));
        $startDayNumber = 0;
        $endDayNumber   = 3287181;

        $dateString = '';
        for ($expectedDayNumber = $startDayNumber; $expectedDayNumber <= $endDayNumber; $expectedDayNumber++) {
            $dateString = $startDateTime->format('Y-m-d');
            $date = new Date($dateString);
            $dateAsDayNumber = $date->serializeToInt();
            $dateDeserialized = new Date($dateAsDayNumber);

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
        $dateDeserialized = new Date($dateAsInt);
        self::assertSame($dateString, $dateDeserialized->serializeToString(), $dateString);
    }

    public function testFirstDayOfMonth(): void
    {
        $date = new Date('2025-12-29');
        $firstDayOfMonth = $date->firstDayOfMonth();
        self::assertSame('2025-12-01', $firstDayOfMonth->serializeToString());
    }

    public function testLastDayOfMonth(): void
    {
        $date = new Date('2024-02-03');
        $lastDayOfMonth = $date->lastDayOfMonth();
        self::assertSame('2024-02-29', $lastDayOfMonth->serializeToString());
    }

    public function testIncrement01(): void
    {
        $date = new Date('2024-01-30');
        $date = $date->increment();
        self::assertSame('2024-01-31', $date->serializeToString());
    }

    public function testIncrement02(): void
    {
        $date = new Date('2024-02-29');
        $date = $date->increment();
        self::assertSame('2024-03-01', $date->serializeToString());
    }

    public function testDecrement01(): void
    {
        $date = new Date('2024-01-30');
        $date = $date->decrement();
        self::assertSame('2024-01-29', $date->serializeToString());
    }

    public function testDecrement02(): void
    {
        $date = new Date('2024-03-01');
        $date = $date->decrement();
        self::assertSame('2024-02-29', $date->serializeToString());
    }
}
