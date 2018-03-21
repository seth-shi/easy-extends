<?php

namespace DavidNineRoc\EasyExtends\Filesystem;


use DavidNineRoc\EasyExtends\Exception\FileNotFoundException;
use ErrorException;

class Filesystem
{

    /**
     * 文件是否存在
     *
     * @param  string  $path
     * @return bool
     */
    public function exists($path)
    {
        return file_exists($path);
    }

    /**
     * 获取一个文件的内容
     *
     * @param  string $path
     * @param  bool $lock
     * @return string
     * @throws FileNotFoundException
     */
    public function get($path, $lock = false)
    {
        if ($this->isFile($path)) {
            return $lock ? $this->sharedGet($path) : file_get_contents($path);
        }

        throw new FileNotFoundException("File does not exist at path {$path}");
    }

    /**
     * 获取文件内容并且上锁
     *
     * @param  string  $path
     * @return string
     */
    public function sharedGet($path)
    {
        $contents = '';

        $handle = fopen($path, 'rb');

        if ($handle) {
            try {
                if (flock($handle, LOCK_SH)) {
                    clearstatcache(true, $path);

                    $contents = fread($handle, $this->size($path) ?: 1);

                    flock($handle, LOCK_UN);
                }
            } finally {
                fclose($handle);
            }
        }

        return $contents;
    }


    /**
     * 把内容写到文件
     *
     * @param  string  $path
     * @param  string  $contents
     * @param  bool  $lock
     * @return int
     */
    public function put($path, $contents, $lock = false)
    {
        return file_put_contents($path, $contents, $lock ? LOCK_EX : 0);
    }

    /**
     * 把内容写到文件前面
     *
     * @param  string  $path
     * @param  string  $data
     * @return int
     */
    public function prepend($path, $data)
    {
        if ($this->exists($path)) {
            return $this->put($path, $data.$this->get($path));
        }

        return $this->put($path, $data);
    }

    /**
     * 把内容追加到文件后面
     *
     * @param  string  $path
     * @param  string  $data
     * @return int
     */
    public function append($path, $data)
    {
        return file_put_contents($path, $data, FILE_APPEND);
    }


    /**
     * 删除文件
     *
     * @param  string|array  $paths
     * @return bool
     */
    public function delete($paths)
    {
        $paths = is_array($paths) ? $paths : func_get_args();

        $success = true;

        foreach ($paths as $path) {
            try {
                if (! @unlink($path)) {
                    $success = false;
                }
            } catch (ErrorException $e) {
                $success = false;
            }
        }

        return $success;
    }

    /**
     * 移动文件
     *
     * @param  string  $path
     * @param  string  $target
     * @return bool
     */
    public function move($path, $target)
    {
        return rename($path, $target);
    }

    /**
     * 复制文件到一个新的路径
     *
     * @param  string  $path
     * @param  string  $target
     * @return bool
     */
    public function copy($path, $target)
    {
        return copy($path, $target);
    }


    /**
     * 获取文件的大小
     *
     * @param  string  $path
     * @return int
     */
    public function size($path)
    {
        return filesize($path);
    }


    /**
     * 是否是目录
     *
     * @param  string  $directory
     * @return bool
     */
    public function isDirectory($directory)
    {
        return is_dir($directory);
    }

    /**
     * 确定给定路径是否可读。
     *
     * @param  string  $path
     * @return bool
     */
    public function isReadable($path)
    {
        return is_readable($path);
    }

    /**
     * 确定给定路径是否可写。
     *
     * @param  string  $path
     * @return bool
     */
    public function isWritable($path)
    {
        return is_writable($path);
    }

    /**
     * 确定给定路径是否为文件。
     *
     * @param  string  $file
     * @return bool
     */
    public function isFile($file)
    {
        return is_file($file);
    }




    /**
     * 创建一个目录。
     *
     * @param  string  $path
     * @param  int     $mode
     * @param  bool    $recursive
     * @param  bool    $force
     * @return bool
     */
    public function makeDirectory($path, $mode = 0755, $recursive = false, $force = false)
    {
        if ($force) {
            return @mkdir($path, $mode, $recursive);
        }

        return mkdir($path, $mode, $recursive);
    }


}
