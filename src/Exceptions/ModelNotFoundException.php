<?php

namespace MichelMelo\JazzRh\Exceptions;

class ModelNotFoundException extends JazzRhException
{
    public function __construct(string $model = 'Model')
    {
        parent::__construct("The {$model} was not found.", 404);
    }
}
