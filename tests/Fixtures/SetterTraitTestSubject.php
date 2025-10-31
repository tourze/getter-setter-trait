<?php

declare(strict_types=1);

namespace Tourze\GetterSetterTrait\Tests\Fixtures;

use Tourze\GetterSetterTrait\Exception\InvalidPropertyValueException;
use Tourze\GetterSetterTrait\SetterTrait;

/**
 * 测试用的Setter类
 */
class SetterTraitTestSubject
{
    use SetterTrait;

    private string $name = '';

    private int $age = 0;

    /** @var array<string, mixed> */
    private array $data = [];

    // 标准setter
    public function setName(string $value): void
    {
        $this->name = $value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    // 带验证的setter
    public function setAge(int $value): void
    {
        if ($value < 0) {
            throw new InvalidPropertyValueException('Age cannot be negative');
        }
        $this->age = $value;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    // 只读属性
    public function getReadOnly(): string
    {
        return 'read-only';
    }

    // 只写属性
    /**
     * @param array<string, mixed> $value
     */
    public function setData(array $value): void
    {
        $this->data = $value;
    }

    /**
     * @return array<string, mixed>
     */
    public function getData(): array
    {
        return $this->data;
    }
}
