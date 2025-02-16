<?php

declare(strict_types=1);

namespace Struct\Exception\Trait;

use Struct\Exception\Contracts\RecursiveExceptionInterface;


trait RecursiveExceptionTrait
{
    protected ?RecursiveExceptionInterface $previousException = null;

    final public function __construct(
        int|RecursiveExceptionInterface $codeOrPrevious,
        protected ?string $reasonOrEmitter = null,
    ) {
        $previous = null;
        if ($codeOrPrevious instanceof \Throwable === true) {
            $code = $codeOrPrevious->getCode();
            $previous = $codeOrPrevious;
            if (is_a($codeOrPrevious, RecursiveExceptionInterface::class) === true) {
                $this->previousException = $codeOrPrevious;
            } else {
                $this->reasonOrEmitter = $codeOrPrevious->getMessage();
            }
        } else {
            $code = $codeOrPrevious;
        }
        $message = $this->_buildMessage();
        parent::__construct($code, $message, $previous);
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
    protected function _buildMessageArray(array &$messageArray, string &$reason, RecursiveExceptionInterface $recursiveException, string $indentation = ''): void
    {
        $previousException = $recursiveException->getPreviousException();
        if ($previousException !== null) {
            $messageArray[] = $indentation . '└→ ' . $previousException->getReasonOrEmitter();
            self::_buildMessageArray($messageArray, $reason, $previousException, $indentation . '  ');
            return;
        }
        $reason = $recursiveException->getReasonOrEmitter();
    }

    public function getPreviousException(): ?RecursiveExceptionInterface
    {
        return $this->previousException;
    }

    public function getReasonOrEmitter(): ?string
    {
        return $this->reasonOrEmitter;
    }

}
