<?php

declare(strict_types=1);

namespace Struct\Exception;

use LogicException;
use Throwable;

final class InvalidStructException extends LogicException
{
    public function __construct(
        int $code,
        protected ?string $structName = null,
        protected ?string $elementName = null,
        protected string $reason,
        ?Throwable $previous = null
    ) {
        $message = 'The struct <' . $this->structName . '> must not: ' . $this->reason;
        if ($elementName !== null) {
            $message = 'The element <' . $this->elementName . '> of struct <' . $this->structName . '> is invalid: ' . $this->reason;
        }
        parent::__construct($message, $code, $previous);
    }
}
