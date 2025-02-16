<?php

declare(strict_types=1);

namespace Struct\Exception;

use RuntimeException;
use Throwable;

/**
 * @deprecated
 */
class SerializeException extends RuntimeException
{
    public readonly ?string $objectPath;

    public function __construct(
        int $code,
        ?string $object = null,
        ?string $message = null,
        ?Throwable $previous = null
    ) {
        $objectPath = null;
        if ($previous instanceof self === true) {
            $objectPath = $previous->objectPath;
        }

        if (
            $object !== null &&
            $objectPath !== null
        ) {
            $objectPath = $object . '->' . $objectPath;
        }

        if (
            $objectPath === null
        ) {
            $objectPath = $object;
        }

        $this->objectPath = $objectPath;

        if ($message === null) {
            $message = $previous->getMessage();
        }

        if ($this->objectPath !== null) {
            $message .= ' in ' . $this->objectPath;
        }

        parent::__construct($message, $code, $previous);
    }
}
