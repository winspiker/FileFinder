<?php

declare(strict_types=1);

namespace FileFinder\Exception;

class OptionsConflictException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('The options "onlyDirectory" and "onlyFile" cannot be both');
    }
}