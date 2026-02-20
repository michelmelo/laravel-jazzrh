<?php

namespace MichelMelo\JazzRh\Exceptions;

use Exception;

class JazzRhException extends Exception
{
    /**
     * Create a new exception instance.
     */
    public function __construct(string $message = '', int $code = 0, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Report the exception.
     */
    public function report(): void
    {
        //
    }

    /**
     * Render the exception.
     */
    public function render(): mixed
    {
        return response()->json([
            'message' => $this->message,
            'code' => $this->code,
        ], 400);
    }
}
