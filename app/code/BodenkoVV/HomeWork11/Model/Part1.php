<?php

declare(strict_types=1);

namespace BodenkoVV\HomeWork11\Model;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;
use RecursiveRegexIterator;
//use Magento\Framework\App\Helper\AbstractHelper;

class Part1
    //extends\Magento\Framework\View\Element\Template implements \Magento\Framework\View\Element\BlockInterface
{
    /**
     * get path listing info
     *
     * @param $path
     * @print string
     */
    public function getPathContent($path = './app')
    {
        $path = realpath($path);
        $directory = new \RecursiveDirectoryIterator($path);
        $iterator = new \RecursiveIteratorIterator($directory, RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($iterator as $filename) {
            if ($filename->isDir()) {
                echo "dir :  -  : ";
            } else {
                $filesize = $filename->getSize();
                echo "file: " . number_format($filesize) . "kB : ";
            }

            $stat = stat($filename->getPathname());
            if (!($stat['mtime'] === null)) {
                $timeModify = date("Y/m/d H:i:s", $stat['mtime']);
            } else {
                $timeModify = '';
            }

            if (!($stat['atime'] === null)) {
                $timeLastAccess = date("Y/m/d H:i:s", $stat['atime']);
            } else {
                $timeLastAccess = $timeModify;
            }
            echo "$timeModify : $timeLastAccess : $filename\n";
        }
    }

    /**
     * execute function to get path info
     *
     * @return string
     */
    public function main()
    {
        $foo1 = new Part1();
        $foo1->getPathContent('./app/code');
    }

}

$foo1 = new Part1();
$foo1->getPathContent('./app/code');
