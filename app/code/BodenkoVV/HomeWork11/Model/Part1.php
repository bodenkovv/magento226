<?php

declare(strict_types=1);

namespace BodenkoVV\HomeWork11\Model;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;
use RecursiveRegexIterator;
//use Magento\Framework\App\Helper\AbstractHelper;

class Part1 extends\Magento\Framework\View\Element\Template implements \Magento\Framework\View\Element\BlockInterface
{
    /**
     * get path listing info
     *
     * @param $path
     * @param $resultPrint
     * @print string
     * @return array
     */
    public function getPathContent($path = './app',$resultPrint = 1)
    {
        $realPath = realpath($path);
        if ($realPath===false)
        {
            $realPath = realpath('./.'.$path);
        }
        if ($realPath===false)
        {
            $realPath = realpath('./../app/code/');
        }
        $result=[];

        $directory = new RecursiveDirectoryIterator($realPath);
        $iterator = new RecursiveIteratorIterator($directory, RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($iterator as $filename) {
            $tmpString='';
            if ($filename->isDir()) {
                $tmpString .= 'dir :  -  : ';
            } else {
                $filesize = $filename->getSize();
                $tmpString .= 'file: ' . number_format($filesize) . 'kB : ';
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
            $tmpString .= "$timeModify : $timeLastAccess : $filename\n";

            if ($resultPrint===1) {
                echo $tmpString ;
            }else {
                $result[]=$tmpString;
            }
        }
        if ($resultPrint===0) return $result;
    }

//    /**
//     * execute function to get path info
//     *
//     * @return string
//     */
//    public function main()
//    {
//      //  $foo1 = new Part1();
//        //$foo1->
//        getPathContent('./app/code/',0);
//    }

}
//
//$foo1 = new Part1();
//$foo1->getPathContent('./app/code/',1);
