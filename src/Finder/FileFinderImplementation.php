<?php

declare(strict_types=1);

namespace FileFinder\Core;

use FileFinder\Models\Options;
use FileFinder\Services\FileFinderService;

class FileFinderImplementation implements FileFinderInterface
{
    private Options $options;

    public function __construct()
    {
        $this->options = new Options();
    }

    public function onlyFiles(): FileFinderInterface
    {
        $this->options->setOnlyFiles(true);
        return $this;
    }

    public function inDir(string $directory): FileFinderInterface
    {
        $this->options->addDirectory($directory);
        return $this;
    }

    public function match(string $regularExpression): FileFinderInterface
    {
        $this->options->setMatch($regularExpression);
        return $this;
    }

    public function onlyDirectories(): FileFinderInterface
    {
        $this->options->setOnlyDirectories(true);
        return $this;
    }

    public function find(): array
    {
        $fileService = new FileFinderService($this->options);

        return $fileService->findFiles();
    }
}