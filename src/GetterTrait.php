<?php

declare(strict_types=1);

namespace Tourze\GetterSetterTrait;

use Tourze\GetterSetterTrait\Exception\InvalidCallException;
use Tourze\GetterSetterTrait\Exception\UnknownPropertyException;

/**
 * @phpstan-ignore-next-line trait.unused
 */
trait GetterTrait
{
    /**
     * 返回对象属性的值。
     *
     * 不要直接调用此方法，因为它是 PHP 魔术方法，
     * 在执行 `$value = $object->property;` 时会被隐式调用。
     *
     * @param string $name 属性名称
     *
     * @return mixed 属性值
     *
     * @throws UnknownPropertyException 如果属性未定义
     * @throws InvalidCallException     如果属性是只写的
     *
     * @see __set()
     */
    public function __get(string $name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            /* @phpstan-ignore-next-line */
            return $this->{$getter}();
        }
        if (method_exists($this, 'set' . $name)) {
            throw new InvalidCallException('Getting write-only property: ' . get_class($this) . '::' . $name);
        }

        throw new UnknownPropertyException('Getting unknown property: ' . get_class($this) . '::' . $name);
    }
}
