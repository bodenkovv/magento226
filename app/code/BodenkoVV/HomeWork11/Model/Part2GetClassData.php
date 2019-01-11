<?php
declare(strict_types=1);
//namespace part2_Class;
namespace BodenkoVV\HomeWork11\Model;

use ReflectionClass;
use ReflectionClassConstant;
use ReflectionMethod;

class ClassContent
{
    const MY_DEF_NAME = 'Big Bob';
    const MY_DEF_SEX = 'man';
    const MY_DEF_OLD = 34;

    /** @var $pub_test1, @var $pub_test2 */
    public $pub_test1, $pub_test2;

    /** @var $priv_test1, @var $priv_test2 */
    private $priv_test1, $priv_test2;

    /**
     * childNameValuePriv
     *
     * @param $name
     * @return $name
     */
    private function childNameValuePriv($name = MY_DEF_NAME)
    {
        return $name;
    }

    /**
     * childNameValuePub
     *
     * @param $name
     * @return $name
     */
    public function childNameValuePub($name = MY_DEF_NAME)
    {
        return $name;
    }
}

class ChildClassContent extends ClassContent
{
    const MY_DEF_NAME_CHILD = 'Bigll Bob';
    const MY_DEF_SEX_CHILD = 'mann';
    const MY_DEF_OLD_CHILD = 35;

    /** @var $pub_test1_child, @var $pub_test2_child */
    public $pub_test1_child, $pub_test2_child;

    /** @var $priv_test1_child, @var $priv_test2_child */
    private $priv_test1_child, $priv_test2_child;


    /**
     * get pub child name
     *
     * @return $childNameValuePub
     */
    public function name()
    {
        return $this->childNameValuePub();
    }
}


class Part2GetClassData extends\Magento\Framework\View\Element\Template implements \Magento\Framework\View\Element\BlockInterface
{
    /**
     * get reflection class Const
     *
     * @param $temp
     * @print string
     * @return array
     * @throws \ReflectionException
     */
    public function getAllConstNameValue()
    {
        $temp = new ChildClassContent();
//        $curGetClassData = new Part2GetClassData();
//        echo "\n ------------ \n";
//        $curGetClassData->getAllConstNameValue($curChildClassContent);

        //$curTemp = new ReflectionClass($temp);
        $curTempClass = new \ReflectionClass($temp);
        $reflectionClass = $curTempClass->getReflectionConstants();
        $result[] = 'All CONST:';
//        echo "\nAll CONST:";
        foreach ($reflectionClass as $items) {
//            echo "\n".$items->class.' : '.$items->name.' : '.$curTempClass->getConstant($items->name);
            $result[]=$items->class.' : '.$items->name.' : '.$curTempClass->getConstant($items->name);
        }

        return $result;
    }

    /**
     * get reflection publick metod
     *
     * @param $temp
     * @print string
     * @return array
     * @throws \ReflectionException
     */
    public function getAllPublicMetod()
    {
        $temp = new ChildClassContent();
        //$curTemp = new \ReflectionClass($temp);
        $curTempClass = new \ReflectionClass($temp);
        $reflectionClass = $curTempClass->getMethods(ReflectionMethod::IS_PUBLIC);
      //  $reflectionClass = new ReflectionMethod('ClassContent');
        $result[] = '\nPublic metods:';
//        echo "Public metods:";
        foreach ($reflectionClass as $items) {
//            echo "\n".$items->class.' : '.$items->name;
            $result[]=$items->class.' : '.$items->name;
        }

        return $result;
    }

    /**
     * execute function to get variables in class and some slass info
     *
     * @print string
     */
    public function main ()
    {
        $curChildClassContent = new ChildClassContent();
        $curGetClassData = new Part2GetClassData();
        echo "\n ------------ \n";
        $curGetClassData->getAllConstNameValue($curChildClassContent);
        echo "\n ------------ \n";
        $curGetClassData->getAllPublicMetod($curChildClassContent);
        echo "\n ----";
    }

}

//
//$curChildClassContent = new ChildClassContent();
//$curGetClassData = new Part2GetClassData();
//
//echo "\n ------------ \n";
//$curGetClassData->getAllConstNameValue($curChildClassContent);
//echo "\n ------------ \n";
//$curGetClassData->getAllPublicMetod($curChildClassContent);
//echo "\n ------------ \n";
