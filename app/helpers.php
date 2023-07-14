<?php
use Illuminate\Support\Facades\File;


if (!function_exists('deleteEmptyFolders')) {
    /**
     * Recursively delete empty folders.
     *
     * @param string $directory
     * @return void
     */
    function deleteEmptyFolders(string $directory): void
    {
        if (!File::isDirectory($directory)) {
            return;
        }

        $sub_directory = File::directories($directory);
        foreach ($sub_directory as $folder) {
            deleteEmptyFolders($folder);
        }

        $sub_file = File::allFiles($directory);
        if (empty($sub_file)) {
            File::deleteDirectory($directory);
        }
    }
}
