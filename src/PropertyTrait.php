<?php

declare(strict_types=1);

namespace Tourze\GetterSetterTrait;

/**
 * @phpstan-ignore-next-line trait.unused
 */
trait PropertyTrait
{
    /**
     * 返回一个值，指示是否定义了属性。
     *
     * 属性被认为已定义，如果：
     *
     * - 类具有与指定名称关联的 getter 或 setter 方法（此时属性名不区分大小写）；
     * - 类具有指定名称的成员变量（当 `$checkVars` 为 true 时）；
     *
     * @param string $name      属性名称
     * @param bool   $checkVars 是否将成员变量视为属性
     *
     * @return bool 属性是否已定义
     *
     * @see canGetProperty()
     * @see canSetProperty()
     */
    public function hasProperty(string $name, bool $checkVars = true): bool
    {
        return $this->canGetProperty($name, $checkVars) || $this->canSetProperty($name, false);
    }

    /**
     * 返回一个值，指示属性是否可读取。
     *
     * 属性被认为可读，如果：
     *
     * - 类具有与指定名称关联的 getter 方法（此时属性名不区分大小写）；
     * - 类具有指定名称的成员变量（当 `$checkVars` 为 true 时）；
     *
     * @param string $name      属性名称
     * @param bool   $checkVars 是否将成员变量视为属性
     *
     * @return bool 属性是否可读
     *
     * @see canSetProperty()
     */
    public function canGetProperty(string $name, bool $checkVars = true): bool
    {
        return method_exists($this, 'get' . $name) || $checkVars && property_exists($this, $name);
    }

    /**
     * 返回一个值，指示属性是否可设置。
     *
     * 属性被认为可写，如果：
     *
     * - 类具有与指定名称关联的 setter 方法（此时属性名不区分大小写）；
     * - 类具有指定名称的成员变量（当 `$checkVars` 为 true 时）；
     *
     * @param string $name      属性名称
     * @param bool   $checkVars 是否将成员变量视为属性
     *
     * @return bool 属性是否可写
     *
     * @see canGetProperty()
     */
    public function canSetProperty(string $name, bool $checkVars = true): bool
    {
        return method_exists($this, 'set' . $name) || $checkVars && property_exists($this, $name);
    }
}
