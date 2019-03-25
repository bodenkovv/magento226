<?php

namespace BodenkoVV\HomeWork11\Model;

class Part3Helper
{
    public $_classString;
    public $_classObj;
    public $_classBool;
    public $_classInt;
    public $_classConstant;
    public $_classArray;
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
