<?php

namespace Release\IO;

use Release\IO\Exception\IOException;

class ComposerIO implements IO
{
    private $_directory;

    public function __construct($directory)
    {
        $this->_directory = $directory;
    }

    public function load()
    {
        if (!is_dir($this->_directory)) {
            throw new IOException(sprintf("%s is not a directory", $this->_directory));
        }
        if (!is_readable($this->_directory)) {
            throw new IOException(sprintf("%s is not readable", $this->_directory));
        }

        $file = $this->getComposerFile($this->_directory);
        if ($file === false) {
            throw new IOException(sprintf("composer.json not found in %s or sub directories", $this->_directory));
        }

        return file_get_contents($file);
    }

    public function save(Release\Version $version)
    {
    }

    private function getComposerFile($directory)
    {
        if (!is_dir($directory)) {
            return false;
        }

        $found = false;
        $di = new \RecursiveDirectoryIterator($directory, \FilesystemIterator::SKIP_DOTS);
        foreach (new \RecursiveIteratorIterator($di) as $filename => $file) {
            if ($file->getFileName() === "composer.json") {
                $found = $file->getPathname();
                break;
            }
        }

        if (!$found) {
            return $this->getComposerFile(dirname($directory));
        }
        return $found;

    }
}
