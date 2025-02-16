<?php

declare(strict_types=1);

namespace Struct\Exception;

use LogicException;
use Throwable;

/**
 * @deprecated
 */
final class InvalidValueException extends LogicException
{
    protected ?InvalidValueException $previousInvalidValueException = null;

    public function __construct(
        int|Throwable $codeOrPrevious,
        protected ?string $reasonOrEmitter = null,
    ) {
        $previous = null;
        if ($codeOrPrevious instanceof \Throwable === true) {
            $code = $codeOrPrevious->getCode();
            $previous = $codeOrPrevious;
            if ($codeOrPrevious instanceof self === true) {
                $this->previousInvalidValueException = $codeOrPrevious;
            } else {
                $this->reasonOrEmitter = $codeOrPrevious->getMessage();
            }
        } else {
            $code = $codeOrPrevious;
        }
        $message = $this->_buildMessage();
        parent::__construct($message, $code, $previous);
    }

    protected function _buildMessage(): string
    {
        $reason = '';
        $messageArray = [];
        $this->_buildMessageArray($messageArray, $reason, $this);

        $message  = $reason . PHP_EOL;
        $message .= implode(PHP_EOL, $messageArray);
        return $message;
    }

    /**
     * @param array<string> $messageArray
     */
    protected function _buildMessageArray(array &$messageArray, string &$reason, self $invalidValueException, string $indentation = ''): void
    {
        $previousInvalidValueException = $invalidValueException->getPreviousInvalidValueException();
        if ($previousInvalidValueException !== null) {
            $messageArray[] = $indentation . '└→ ' . $invalidValueException->getReasonOrEmitter();
            self::_buildMessageArray($messageArray, $reason, $previousInvalidValueException, $indentation . '  ');
            return;
        }
        $reason = $invalidValueException->getReasonOrEmitter();
    }

    public function getReasonOrEmitter(): ?string
    {
        return $this->reasonOrEmitter;
    }

    public function getPreviousInvalidValueException(): ?self
    {
        return $this->previousInvalidValueException;
    }
}
