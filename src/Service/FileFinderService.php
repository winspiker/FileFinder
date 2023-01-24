<?php

declare(strict_types=1);

namespace FileFinder\Services;

use FileFinder\Exception\EmptyDirectoryException;
use FileFinder\Exception\OptionsConflictException;
use FileFinder\Helpers\FileManager;
use FileFinder\Models\Options;

final class FileFinderService
{
    private Options $options;

    public function __construct(Options $options)
    {
        $this->options = $options;
    }

    public function findFiles(): array
    {
        $directories = $this->options->getDirectories();
        if ([] === $directories) {
            throw new EmptyDirectoryException();
        }

        if ($this->options->getOnlyFiles() && $this->options->getOnlyDirectory()) {
            throw new OptionsConflictException();
        }

        $dirContents = FileManager::scanDir($directories);
        if ($this->options->getOnlyDirectory()) {
            $dirContents = array_filter($dirContents, 'is_dir');
        }

        if ($this->options->getOnlyFiles()) {
            $dirContents = array_filter($dirContents, 'is_file');
        }

        if (!$this->options->getMatches()) {
            return $dirContents;
        }

        $matchCallback = function (string $dirContent) {
            foreach ($this->options->getMatches() as $match) {
                $matched = preg_match($match, $dirContent);
                if (1 === $matched) {
                    return true;
                }
            }
            return false;
        };

        return array_values(array_filter($dirContents, $matchCallback));
    }

}