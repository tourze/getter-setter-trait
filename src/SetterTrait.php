<?php

namespace Tourze\GetterSetterTrait;

use yii\base\InvalidCallException;
use yii\base\UnknownPropertyException;

trait SetterTrait
{
    /**
     * Sets value of an object property.
     *
     * Do not call this method directly as it is a PHP magic method that
     * will be implicitly called when executing `$object->property = $value;`.
     *
     * @param string $name  the property name or the event name
     * @param mixed  $value the property value
     *
     * @throws UnknownPropertyException if the property is not defined
     * @throws InvalidCallException     if the property is read-only
     *
     * @see __get()
     */
    public function __set(string $name, $value): void
    {
        $setter = 'set' . $name;
        if (method_exists($this, $setter)) {
            $this->$setter($value);
        } elseif (method_exists($this, 'get' . $name)) {
            throw new InvalidCallException('Setting read-only property: ' . get_class($this) . '::' . $name);
        } else {
            throw new UnknownPropertyException('Setting unknown property: ' . get_class($this) . '::' . $name);
        }
    }
}
