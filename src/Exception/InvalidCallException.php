<?php

declare(strict_types=1);

/**
 * @see https://www.yiiframework.com/
 *
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace Tourze\GetterSetterTrait\Exception;

/**
 * InvalidCallException 表示由以错误方式调用方法引起的异常。
 *
 * 当通过魔法方法尝试以错误的方式访问属性时抛出此异常，例如：
 * - 尝试读取只写属性
 * - 尝试写入只读属性
 * - 调用不可访问的getter/setter方法
 *
 * @throws InvalidCallException 当属性访问方式不当时抛出
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class InvalidCallException extends \BadMethodCallException
{
}
