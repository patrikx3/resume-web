<?php

namespace P3x;

/**
 * Class File
 * @package P3x
 */
class File
{
    /**
     * @var int
     */
    static $LastModification = -1;
    //public static $last_count_modified = 0;
    //public static $last_files_modified = [];

    /**
     * @param $file
     * @param $content_type
     */
    static function StreamFile($file, $content_type)
    {
        Analytics::Track();
        $file_time = filemtime($file);
        if (Http::LastModifiedSent($file_time)) {
            return;
        }
        // Image not cached or cache outdated, we respond '200 OK' and output the image.
        header('Content-Description: File Transfer');
        Http::GenerateLastModified($file_time);
        header('Content-Disposition: inline; filename="' . basename($file) . '"');
        Http::HeaderContent($content_type);
        header('Content-Length: ' . filesize($file));
        echo file_get_contents($file);
    }

    /**
     * @param $file
     * @param string $mode
     * @return null|string
     */
    static function ReadLocked($file, $mode = 'r')
    {
        $fp = fopen($file, $mode);
        flock($fp, LOCK_SH);
        $size = filesize($file);
        $contents = null;
        if ($size > 0) {
            $contents = fread($fp, $size);
        }
        flock($fp, LOCK_UN);    // release the lock
        fclose($fp);
        return $contents;
    }

    /**
     * @param $file
     * @param $data
     */
    static function WriteLocked($file, $data)
    {
        $fp = fopen($file, 'w+');
        $flock = flock($fp, LOCK_EX);
        fwrite($fp, $data);
        flock($fp, LOCK_UN);
        fclose($fp);
    }

    /**
     * @return int
     */
    static function GetLastModification()
    {
        if (static::$LastModification == -1) {
            $lastModification = static::AllModified(
                rtrim(ROOT, DIRECTORY_SEPARATOR), 0, [
                    ROOT . '.idea',
                    ROOT . 'design',
                    ROOT . 'documents',
                    ROOT . 'vendor',
                    ROOT . '.ftpquota',
                    ROOT . 'public' . DIRECTORY_SEPARATOR . 'error_log',
                    ROOT . 'public' . DIRECTORY_SEPARATOR . 'content' . DIRECTORY_SEPARATOR . 'resume',
                ]
            );
        }
        return $lastModification;
    }

    /**
     * @param $root
     * @param int $lastModified
     * @param array $filesExclude
     * @return int
     */
    static function AllModified($root, $lastModified = 0, $filesExclude = array())
    {
        //if ($last_modified == 0) {
        //    static::$last_count_modified = 0;
        //    static::$last_files_modified = [];
        //}
        //static::$last_count_modified++;

        if (in_array($root, $filesExclude)) {
            return $lastModified;
        }
        $current_modified = filemtime($root);

        //static::$last_files_modified[] = $root;
        //static::$last_count_modified++;

        $lastModified = $current_modified > $lastModified ? $current_modified : $lastModified;

        $dirs = scandir($root);
        foreach ($dirs as $filename) {
            if ($filename != '.' && $filename != '..') {
                if (is_dir($root . DIRECTORY_SEPARATOR . $filename)) {
                    $new_modified = static::AllModified($root . DIRECTORY_SEPARATOR . $filename, $lastModified, $filesExclude);
                    $lastModified = $new_modified > $lastModified ? $new_modified : $lastModified;
                } else {
                    $actual_filename = $root . DIRECTORY_SEPARATOR . $filename;
                    if (in_array($actual_filename, $filesExclude)) {
                        continue;
                    }
                    //static::$last_files_modified[] = $actual_filename;
                    $new_modified = filemtime($actual_filename);
                    $lastModified = $new_modified > $lastModified ? $new_modified : $lastModified;
                    //static::$last_count_modified++;
                }
            }
        }
        return $lastModified;
    }

    /**
     * @param $dir
     */
    static function DeleteDirRecursive($dir)
    {
        if (!is_dir($dir)) {
            return;
        }
        if (Application::IsWin()) {
            exec('rmdir /s /q ' . $dir);
        } else {
            exec('rm -R ' . $dir);
        }
    }

    /**
     * @param $filename
     * @param $data
     * @param int $mode
     */
    static function EnsurePutContents($filename, $data, $mode = 0777)
    {
        static::EnsureDirectory(dirname($filename), $mode);
        file_put_contents($filename, $data);

    }

    /**
     * @param $dir
     * @param int $mode
     */
    static function EnsureDirectory($dir, $mode = 0777)
    {
        if (!is_dir($dir)) {
            mkdir($dir, $mode, true);
        }
    }
}
