<?php

namespace App\Helpers;

class Copy
{
    /**
     * @param $source
     * @param $destination
     * @param int $permissions
     * @return bool
     */
    public static  function all($source, $destination, $permissions = 0755)
    {
        // Check for symlinks
        if (is_link($source)) {
            return symlink(readlink($source), $destination);
        }

        // Simple copy for a file
        if (is_file($source)) {
            return copy($source, $destination);
        }

        // Make destination directory
        if (!is_dir($destination)) {
            mkdir($destination, $permissions);
        }

        // Loop through the folder
        $dir = dir($source);
        while (false !== $entry = $dir->read()) {
            // Skip pointers
            if ($entry == '.' || $entry == '..') {
                continue;
            }

            // Deep copy directories
            self::all("$source/$entry", "$destination/$entry", $permissions);
        }

        // Clean up
        $dir->close();
        return true;
    }
}