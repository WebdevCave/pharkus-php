<?php

namespace Webdevcave\Pharkus\Filesystem;

use DateTime;

class DirectoryCrawler
{
    public function __construct(
        private string $dir
    )
    {
    }

    /**
     * Get the update datetime based on the most recent updated item.
     *
     * @param string|null $dir
     *
     * @return DateTime
     */
    public function getLastDirectoryUpdateDate(string $dir = null): DateTime
    {
        $lastUpdate = null;
        $dir = $dir ?? $this->dir;

        foreach(scandir($dir) as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }

            $item = $dir.DIRECTORY_SEPARATOR.$file;

            if (is_dir($file)) {
                $subDirLastUpdate = $this->getLastDirectoryUpdateDate($item)
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

    /**
     * Crawl searching for classes in a PSR-4 based directory structure.
     * $enforce will check each item class declaration. Safer but might be slow. Default: false (skip check)
     *
     * @param string $namespace
     * @param string|null $dir
     * @param bool $enforce
     *
     * @return array
     */
    public function getClassList(string $namespace, string $dir = null, bool $enforce = false): array
    {
        $dir = $dir ?? $this->dir;
        $classes = [];

        foreach (scandir($dir) as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }

            $dirCheck = $dir.DIRECTORY_SEPARATOR.$file;

            if (is_dir($dirCheck)) {
                $subClasses = $this->getClassList("$namespace\\$file", $dirCheck, $enforce);
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
}
