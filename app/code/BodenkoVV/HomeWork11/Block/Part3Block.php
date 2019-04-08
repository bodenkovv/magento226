<?php

namespace BodenkoVV\HomeWork11\Block;

use ReflectionMethod;

class Part3Block extends \Magento\Framework\View\Element\Template
{

    /**
     * return string with Variables and values
     *
     * @param string $temp
     * @return string
     * @throws \ReflectionException
     */
 public function getAllConstNameValue($temp)
    {
        $curTempClass = new \ReflectionClass($temp);
        $reflectionClass = $curTempClass->getReflectionConstants();
        $result = '';
        foreach ($reflectionClass as $items) {
            $result = $result."\n".$items->class.' : '.$items->name.' : '.$curTempClass->getConstant($items->name);
        }

        return $result;
    }

    /**
     * return string with Classes
     *
     * @param string $temp
     * @return string
     * @throws \ReflectionException
     */
    public function getAllPublicMetod($temp)
    {
        $curTempClass = new \ReflectionClass($temp);
        $result = '';
        $reflectionClass = $curTempClass->getMethods(ReflectionMethod::IS_PUBLIC);
        foreach ($reflectionClass as $items) {
            $result = $result."\n".$items->class.' : '.$items->name.' : '.$curTempClass->getConstant($items->name);
        }

        return $result;
    }

}
