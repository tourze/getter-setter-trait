<?php

namespace Tourze\GetterSetterTrait;

use Tourze\GetterSetterTrait\Exception\InvalidCallException;
use Tourze\GetterSetterTrait\Exception\UnknownPropertyException;

trait GetterTrait
{
    /**
     * Returns the value of an object property.
     *
     * Do not call this method directly as it is a PHP magic method that
     * will be implicitly called when executing `$value = $object->property;`.
     *
     * @param string $name the property name
     *
     * @return mixed the property value
     *
     * @throws UnknownPropertyException if the property is not defined
     * @throws InvalidCallException     if the property is write-only
     *
     * @see __set()
     */
    public function __get(string $name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter();
        } elseif (method_exists($this, 'set' . $name)) {
            throw new InvalidCallException('Getting write-only property: ' . get_class($this) . '::' . $name);
        }

        throw new UnknownPropertyException('Getting unknown property: ' . get_class($this) . '::' . $name);
    }
}
