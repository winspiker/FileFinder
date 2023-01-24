<?php

namespace FileFinder\Core;

interface FileFinderInterface
{

    /**
     * Search in directory $directory.
     * If called multiple times, the result must include paths from all provided directories.
     */
    public function inDir(string $directory): self;

    /** Filter: only files, ignore directories */
    public function onlyFiles(): self;

    /** Filter: only directories, ignore files */
    public function onlyDirectories(): self;

    /**
     * Filter by regular expression on full path.
     * If called multiple times, the result must include paths that match at least one of the provided expressions.
     */
    public function match(string $regularExpression): self;


    /**
     * Returns array of all found files/directories (full path)
     * @return string[]
     */
    public function find(): array;

}