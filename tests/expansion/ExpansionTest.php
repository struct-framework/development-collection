<?php

declare(strict_types=1);

namespace Struct\Expansion\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use Struct\Expansion\UserException;

class ExpansionTest extends TestCase
{
    public function testIncrement(): void
    {
        $this->throwUserException();
    }


    protected function throwUserException(): void
    {
        throw new UserException(1723054624, '');
    }


    protected function throwProgrammeException(): void
    {
        throw new UserException(1723054722, '');
    }

    /**
     * @return void
     * @throws Exception
     */
    protected function throwRegularException(): void
    {
        throw new Exception('', 1723054802);
    }
}
