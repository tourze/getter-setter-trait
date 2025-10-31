<?php

declare(strict_types=1);

namespace Tourze\GetterSetterTrait\Exception;

/**
 * InvalidPropertyValueException 表示由无效属性值引起的异常。
 *
 * 当尝试为属性设置无效的值时抛出此异常，例如：
 * - 值的类型不符合属性要求
 * - 值不符合属性的验证规则
 * - 值超出了允许的范围
 *
 * 此异常通常在setter方法中进行值验证时使用。
 *
 * @throws InvalidPropertyValueException 当属性值无效时抛出
 */
class InvalidPropertyValueException extends \RuntimeException
{
}
