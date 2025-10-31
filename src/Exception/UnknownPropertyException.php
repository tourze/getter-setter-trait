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
 * UnknownPropertyException 表示由访问未知对象属性引起的异常。
 *
 * 当通过魔法方法尝试访问不存在的属性时抛出此异常，例如：
 * - 尝试读取对象未定义的属性
 * - 尝试写入对象未定义的属性
 * - 对象中不存在对应的getter/setter方法
 *
 * 此异常帮助开发者识别和修复属性名称错误或属性定义缺失的问题。
 *
 * @throws UnknownPropertyException 当访问的属性不存在时抛出
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class UnknownPropertyException extends \Exception
{
}
