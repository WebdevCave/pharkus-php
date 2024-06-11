<?php

namespace Webdevcave\Pharkus\Filesystem;

use DateTime;

/**
 * Interacts through all items and subdirectories in a path.
 */
class DirectoryCrawler
{
    /**
     * @param string $dir
     */
    public function __construct(
        private readonly string $dir
    )
    {
    }

    /**
     * Crawl searching for classes in a PSR-4 based directory structure.
     * $enforce will check each item class declaration. Safer but might be slow. Default: false (skip check)
     *
     * @param string $namespace
     * @param bool $enforce
     *
     * @return string[]
     */
    public function classes(string $namespace, bool $enforce = false): array
    {
        return $this->listClasses($this->dir, $namespace, $enforce);
    }

    /**
     * Get the update datetime based on the most recent updated item.
     *
     * @return DateTime
     */
    public function lastUpdated(): DateTime
    {
        return $this->searchLastUpdatedItem($this->dir);
    }

    /**
     * Search for classes inside a directory.
     *
     * @param string $dir
     * @param string $namespace
     * @param bool $enforce
     *
     * @return string[]
     */
    private function listClasses(string $dir, string $namespace, bool $enforce): array
    {
        $classes = [];

        foreach (scandir($dir) as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }

            $dirCheck = $dir.DIRECTORY_SEPARATOR.$file;

            if (is_dir($dirCheck)) {
                $subClasses = $this->listClasses("$namespace\\$file", $dirCheck, $enforce);
                array_push($classes, ...$subClasses);

                continue;
            }

            $className = $namespace.'\\'.substr($file, 0, -4); //Remove '.php' extension

            if ($enforce && !class_exists($className)) {
                continue;
            }

            $classes[] = $className;
        }

        return $classes;
    }

    /**
     * Crawl directory and subdirectories searching for the most recent updated item.
     *
     * @param string $dir
     *
     * @return DateTime
     */
    private function searchLastUpdatedItem(string $dir): DateTime
    {
        $lastUpdate = null;

        foreach(scandir($dir) as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }

            $item = $dir.DIRECTORY_SEPARATOR.$file;

            if (is_dir($file)) {
                $subDirLastUpdate = $this->searchLastUpdatedItem($item)
                    ->getTimestamp();

                if ($subDirLastUpdate > $lastUpdate) {
                    $lastUpdate = $subDirLastUpdate;
                }

                continue;
            }

            $fileLastUpdate = filemtime($item);

            if ($fileLastUpdate > $lastUpdate) {
                $lastUpdate = $fileLastUpdate;
            }
        }

        $date = new DateTime();
        $date->setTimestamp($lastUpdate);

        return $date;
    }
}
