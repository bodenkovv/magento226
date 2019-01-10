<?php

namespace BodenkoVV\HomeWork11\Model;

//use Magento\Framework\App\Helper\AbstractHelper;

class Part3Helper //extends AbstractHelper
{
    public $_classString;//='tessssst';
    public $_classObj;//='\BodenkoVV\HomeWork11\NativePhp\Part1';
    public $_classBool;//=false;
    public $_classInt;//=2;
    public $_classConstant;//=111;
    public $_classArray;//=[];
    public $_classA='fffff';


    /**
     *Constructor
     *
     * @param $_classString ,
     * @param $_classObj ,
     * @param $_classBool ,
     * @param $_classInt ,
     * @param $_classConstant ,
     * @param $_classArray
     */
    public function __construct(
        $_classString, $_classObj, $_classBool, $_classInt, $_classConstant, $_classArray
    ) {
        $this->_classString = $_classString;
        $this->_classObj = $_classObj;
        $this->_classBool = $_classBool;
        $this->_classInt = $_classInt;
        $this->_classConstant = $_classConstant;
        $this->_classArray = $_classArray;
    }

}
