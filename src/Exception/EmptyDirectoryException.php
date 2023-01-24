<?php

declare(strict_types=1);

namespace FileFinder\Exception;

class EmptyDirectoryException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Directory was not specified');
    }
}