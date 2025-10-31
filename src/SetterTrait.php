<?php

declare(strict_types=1);

namespace Tourze\GetterSetterTrait;

use Tourze\GetterSetterTrait\Exception\InvalidCallException;
use Tourze\GetterSetterTrait\Exception\UnknownPropertyException;

/**
 * @phpstan-ignore-next-line trait.unused
 */
trait SetterTrait
{
    /**
     * 设置对象属性的值。
     *
     * 不要直接调用此方法，因为它是 PHP 魔术方法，
     * 在执行 `$object->property = $value;` 时会被隐式调用。
     *
     * @param string $name  属性名称或事件名称
     * @param mixed  $value 属性值
     *
     * @throws UnknownPropertyException 如果属性未定义
     * @throws InvalidCallException     如果属性是只读的
     *
     * @see __get()
     */
    public function __set(string $name, mixed $value): void
    {
        $setter = 'set' . $name;
        if (method_exists($this, $setter)) {
            /* @phpstan-ignore-next-line */
            $this->{$setter}($value);
        } elseif (method_exists($this, 'get' . $name)) {
            throw new InvalidCallException('Setting read-only property: ' . get_class($this) . '::' . $name);
        } else {
            throw new UnknownPropertyException('Setting unknown property: ' . get_class($this) . '::' . $name);
        }
    }
}
