<?php

declare(strict_types=1);

namespace Tourze\GetterSetterTrait\Tests\Fixtures;

use Tourze\GetterSetterTrait\PropertyTrait;

/**
 * 测试用的PropertyTrait类
 */
class PropertyTraitTestSubject
{
    use PropertyTrait;

    private string $name = 'test';

    private int $age = 25;

    /** @var array<string, string> */
    protected array $data = ['key' => 'value'];

    // 只读属性
    public function getName(): string
    {
        return $this->name;
    }

    // 标准getter/setter
    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $value): void
    {
        $this->age = $value;
    }

    // 只写属性
    public function setWriteOnly(string $value): void
    {
        // 这是一个只写属性
    }

    // 计算属性（只读）
    public function getFullName(): string
    {
        return $this->name . '_calculated';
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
