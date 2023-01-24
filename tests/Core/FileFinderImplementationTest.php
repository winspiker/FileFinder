<?php

declare(strict_types=1);

namespace FileFinder\Tests\Core;

use FileFinder\Finder\FileFinderImplementation;
use FileFinder\Exception\EmptyDirectoryException;
use FileFinder\Exception\OptionsConflictException;
use PHPUnit\Framework\TestCase;

class FileFinderImplementationTest extends TestCase
{

    public function testFileFinderDir(): void
    {

        $finder = new FileFinderImplementation();
        $finder
            ->onlyDirectories()
            ->inDir('test_dir')
            ->match('/bar/');
        $result = ['test_dir/bar'];
        $this->assertEquals($result, $finder->find());
    }

    public function testFileFinderAll(): void
    {

        $finder = new FileFinderImplementation();
        $finder
            ->inDir(__DIR__ . '/test_dir/');
        $result = [
            __DIR__ . '/test_dir/bar',
            __DIR__ . '/test_dir/foo',
            __DIR__ . '/test_dir/test.ini',
            __DIR__ . '/test_dir/test.log',
            __DIR__ . '/test_dir/test.php'
        ];

        $this->assertEquals($result, $finder->find());
    }

    public function testFileFinderFile(): void
    {

        $finder = new FileFinderImplementation();
        $finder
            ->onlyFiles()
            ->inDir('test_dir')
            ->match('/.*\.log$/')
            ->match('/.*\.ini$/');
        $result = [
            'test_dir/test.ini', 'test_dir/test.log'];
        $this->assertEquals($result, $finder->find());
    }

    public function testFileFinderDirectoryFail(): void
    {

        $this->expectException(EmptyDirectoryException::class);
        $this->expectExceptionMessage('Directory was not specified');

        $finder = new FileFinderImplementation();
        $finder
            ->onlyFiles()
            ->match('/.*\.log$/')
            ->match('/.*\.ini$/');
        $finder->find();
    }

    public function testFileFinderOptionsConflictFail(): void
    {

        $this->expectException(OptionsConflictException::class);
        $this->expectExceptionMessage('The options "onlyDirectory" and "onlyFile" cannot be both');

        $finder = new FileFinderImplementation();
        $finder
            ->onlyFiles()
            ->onlyDirectories()
            ->inDir('test_dir')
            ->match('/.*\.ini$/');
        $finder->find();
    }
}
