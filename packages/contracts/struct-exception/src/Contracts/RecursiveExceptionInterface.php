<?php

declare(strict_types=1);

namespace Struct\Exception\Contracts;

interface RecursiveExceptionInterface extends \Throwable
{
    public function getPreviousException(): ?RecursiveExceptionInterface;
    public function getReasonOrEmitter(): ?string;
}
