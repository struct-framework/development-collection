<?php

declare(strict_types=1);

namespace Struct\DataType;

use Struct\DataType\Exception\DeserializeException;
use Struct\DataType\Exception\InvalidArgumentException;
use Struct\Struct\Contracts\DataTypeInterface;

class Month implements DataTypeInterface, \Stringable
{
    protected int $year;

    protected int $month;

    public function __construct(?string $serializedMonth = null)
    {
        if($serializedMonth === null) {
            return;
        }
        $this->_deserializeToString($serializedMonth);
    }


    public function setMonth(int $month): void
    {
        if($month < 1 || $month > 12) {
            throw new InvalidArgumentException('The month must be between 1 and 12', 1696052867);
        }
        $this->month = $month;
    }

    public function setYear(int $year): void
    {
        if($year < 1000 || $year > 9999) {
            throw new InvalidArgumentException('The year must be between 1000 and 9999', 1696052931);
        }
        $this->year = $year;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getMonth(): int
    {
        return $this->month;
    }


    public function serializeToString(): string
    {
        $monthString = (string) $this->month;
        if(strlen($monthString) === 1) {
            $monthString = '0' . $monthString;
        }
        $serializedData = $this->year . '-' . $monthString;
        return $serializedData;
    }


    public static function deserializeToString(string $serializedData): self
    {
        $monthModel = new Month();
        $monthModel->_deserializeToString($serializedData);
        return $monthModel;
    }

    private function _deserializeToString(string $serializedData)
    {
        if(\strlen($serializedData) !== 7) {
            throw new DeserializeException('The value serialized data string must have 7 characters', 1696227826);
        }
        $parts = \explode('-', $serializedData);
        if(\count($parts) !== 2) {
            throw new DeserializeException('The value serialized data must year und month to parts separate by -', 1696227896);
        }
        $year = (int) $parts[0];
        $month = (int) $parts[1];

        try {
            $this->setYear($year);
        } catch (InvalidArgumentException $exception) {
            throw new DeserializeException('Invalid year: ' . $exception->getMessage(), 1696228152, $exception);
        }

        try {
            $this->setMonth($month);
        } catch (InvalidArgumentException $exception) {
            throw new DeserializeException('Invalid month: ' . $exception->getMessage(), 1696228168, $exception);
        }
    }

    public function __toString(): string
    {
        return $this->serializeToString();
    }


}
