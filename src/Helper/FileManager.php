<?php

declare(strict_types=1);

namespace FileFinder\Helpers;

final class FileManager
{
    public static string $directory;

    public static function scanDir(array $directories): array
    {
        $result = [];

        foreach ($directories as $directory) {
            $directory = rtrim($directory, '/') . '/';
            $toFullPath = static fn (string $content) => $directory . $content;
            $dirContent = array_diff(\scandir($directory), ['.', '..']);

            $result[] = array_map($toFullPath, $dirContent);
        }

        return array_merge(...$result);
    }

}
