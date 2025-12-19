<?php

declare(strict_types=1);

namespace Tourze\GetterSetterTrait\Tests\Fixtures;

use Tourze\GetterSetterTrait\GetterTrait;

/**
 * 测试用的Getter类
 *
 * @property string $name 读取名称属性
 * @property int $age 读取年龄属性
 * @property int $calculatedValue 读取计算值
 * @property string $unknownProperty 访问未知属性（测试用）
 * @property string $secretKey 访问只写属性（测试用）
 */
class GetterTraitTestSubject
{
    use GetterTrait;

    private string $name = 'test';

    private int $age = 25;

    // 只读属性
    public function getName(): string
    {
        return $this->name;
    }

    // 标准getter
    public function getAge(): int
    {
        return $this->age;
    }

    // 没有对应属性的getter
    public function getCalculatedValue(): int
    {
        return 100;
    }

    // 只写属性
    public function setSecretKey(string $value): void
    {
        // 这是一个只写属性
    }
}
