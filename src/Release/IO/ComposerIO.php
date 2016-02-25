<?php

namespace Release\IO;

use Release\IO\Exception\IOException;

class ComposerIO implements IOInterface
{
    private $_directory;

    public function __construct($directory)
    {
        $this->_directory = $directory;
    }

    public function load()
    {
        $file = $this->getComposerFile();
        return file_get_contents($file);
    }

    public function save($data)
    {
        $file = $this->getComposerFile();
        if (!is_writable($file)) {
            throw new IOException(sprintf("Failed to save file %s, permission denied!", $file));
        }
        file_put_contents($file, $data);
    }

    private function getComposerFile()
    {
        if (!is_dir($this->_directory)) {
            throw new IOException(sprintf("%s is not a directory", $this->_directory));
        }
        if (!is_readable($this->_directory)) {
            throw new IOException(sprintf("%s is not readable", $this->_directory));
        }
        $file = $this->getComposerFileRecursive($this->_directory);
        if ($file === false) {
            throw new IOException(sprintf("composer.json not found in %s or sub directories", $this->_directory));
        }
        return $file;
    }

    private function getComposerFileRecursive($directory)
    {
        if (!is_dir($directory) || !is_readable($this->_directory)) {
            return false;
        }

        $found = false;
        $di = new \DirectoryIterator($directory);
        foreach ($di as $filename => $file) {
            if ($file->getFileName() === "composer.json") {
                $found = $file->getPathname();
                break;
            }
        }

        if (!$found && $directory != dirname($directory)) {
            return $this->getComposerFileRecursive(dirname($directory));
        }
        return $found;

    }
}
