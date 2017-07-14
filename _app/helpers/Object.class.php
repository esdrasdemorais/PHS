<?php
/**
 * Description of Object
 *
 * @author esdrassilva
 */
abstract class Object
{
    function toArray($obj)
    {
        if (is_object($obj)) {
            $obj = (array) $this->dismountObject($obj);
        }
        if (is_array($obj)) {
            $new = array();
            foreach ($obj as $key => $val) {
                $new[$key] = $this->toArray($val);
            }
        } else {
            $new = $obj;
        }
        return $new;
    }
    
    function dismountObject($object)
    {
        $reflectionClass = new \ReflectionClass(get_class($object));
        $array = array();
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);
            $array[$property->getName()] = $property->getValue($object);
            $property->setAccessible(false);
        }
        return $array;
    }
}
