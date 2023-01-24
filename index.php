<?php

declare(strict_types=1);

use FileFinder\Finder\FileFinderImplementation;

require_once 'vendor/autoload.php';

# Приклади використання FileFinderImplementation:

# search for all .conf or .ini files in directories /etc/ and /var/log/
$finder = new FileFinderImplementation();

# complex search in multiple directories
$finder
->onlyFiles()
->inDir('/etc/')
->inDir('/var/log/')
->match('/.*\.conf$/')
->match('/.*\.ini$/');
foreach ($finder->find() as $file) {
print $file . "\n";
}
print "\n\n";


# search for all files in /tmp
$finder = (new FileFinderImplementation())
->onlyFiles()
->inDir('/tmp');
foreach ($finder->find() as $file) {
print $file . "\n";
}
print "\n\n";


# search for .doc files in /tmp
$finder = (new FileFinderImplementation())
->match('/.*\.doc$/')
->onlyFiles()
->inDir('/tmp');
foreach ($finder->find() as $file) {
print $file . "\n";
}
print "\n\n";


# list all directories in /var
$finder = (new FileFinderImplementation())
->onlyDirectories()
->inDir('/var/log/');
foreach ($finder->find() as $file) {
print $file . "\n";
}
print "\n\n";


# should throw an exception if no directories were provided
try {
$files = (new FileFinderImplementation())
->onlyFiles()
->match('/.*\.ini$/')
->find(); # -> exception
print "When no dir were provided: exception was not thrown, something does not work correctly\n";
} catch (\Exception $exception) {
print "When no dir were provided: exception was thrown with message \"" . $exception->getMessage() . "\"\n";
}