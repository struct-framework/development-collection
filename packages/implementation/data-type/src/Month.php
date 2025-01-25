<?php

declare(strict_types=1);

namespace Struct\DataType;

use InvalidArgumentException;
use Struct\Exception\DeserializeException;
use function count;
use function explode;
use function strlen;

final readonly class Month extends AbstractDataTypeInteger
{
    public int $year;

    public int $month;

    public function __construct(string|int $serializedData)
    {
        $result = $this->_deserialize($serializedData);
        $this->year = $result[0];
        $this->month = $result[1];
    }

    public function withMonth(int $month): self
    {
        if ($month < 1 || $month > 12) {
            throw new InvalidArgumentException('The month must be between 1 and 12', 1696052867);
        }
        return self::createByYearMonth($this->year, $month);
    }

    public function withYear(int $year): self
    {
        if ($year < 1000 || $year > 9999) {
            throw new InvalidArgumentException('The year must be between 1000 and 9999', 1696052931);
        }
        return self::createByYearMonth($year, $this->month);
    }

    public static function createByYearMonth(int $year, int $month): self
    {
        $yearString = (string) $year;
        $monthString = (string) $month;
        if(strlen($monthString) === 1) {
            $monthString = '0' . $monthString;
        }
        $date = new self($yearString. '-'. $monthString);
        return $date;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getMonth(): int
    {
        return $this->month;
    }

    public function firstDayOfMonth(): Date
    {
        $date = Date::createByYearMonthDay($this->year, $this->month, 1);
        return $date;
    }

    public function lastDayOfMonth(): Date
    {
        $firstDayOfMonth = $this->firstDayOfMonth();
        $date = $firstDayOfMonth->lastDayOfMonth();
        return $date;
    }

    protected function _serializeToString(): string
    {
        $monthString = (string) $this->month;
        if (strlen($monthString) === 1) {
            $monthString = '0' . $monthString;
        }
        $serializedData = $this->year . '-' . $monthString;
        return $serializedData;
    }

    /**
     * @return array{0:int, 1:int}
     */
    protected function _deserialize(string|int $serializedData): array
    {
        if(is_int($serializedData) === true) {
            return $this->_deserializeFromInt($serializedData);
        }
        if (strlen($serializedData) !== 7) {
            throw new DeserializeException('The value serialized data string must have 7 characters', 1696227826);
        }
        $parts = explode('-', $serializedData);
        if (count($parts) !== 2) {
            throw new DeserializeException('The value serialized data must year und month to parts separate by -', 1696227896);
        }
        $year = (int) $parts[0];
        $month = (int) $parts[1];

        return [$year, $month];
    }


    protected function _serializeToInt(): int
    {
        $monthAsInt = $this->year * 12;
        $monthAsInt += $this->month - 1;
        return $monthAsInt;
    }

    /**
     * @return array{0:int, 1:int}
     */
    protected function _deserializeFromInt(int $serializedData): array
    {
        $year = (int) ($serializedData / 12);
        $month = ($serializedData % 12) + 1;
        return [$year, $month];
    }
}
