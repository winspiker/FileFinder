<?php

declare(strict_types=1);

namespace FileFinder\Models;

final class Options
{
    private array $directories = [];
    private bool $onlyFiles = false;
    private bool $onlyDirectories = false;
    private array $matches = [];

    public function addDirectory(string $directory): void
    {
        $this->directories[] = $directory;
    }

    public function setMatch(string $regularExpression): void
    {
        $this->matches[] = $regularExpression;
    }

    public function setOnlyFiles(bool $onlyFiles): void
    {
        $this->onlyFiles = $onlyFiles;
    }

    public function setOnlyDirectories(bool $onlyDirectories): void
    {
        $this->onlyDirectories = $onlyDirectories;
    }

    public function getDirectories(): array
    {
        return $this->directories;
    }

    public function getMatches(): array
    {
        return $this->matches;
    }

    public function getOnlyFiles(): bool
    {
        return $this->onlyFiles;
    }

    public function getOnlyDirectory(): bool
    {
        return $this->onlyDirectories;
    }

}