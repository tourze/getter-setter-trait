<?php

declare(strict_types=1);

namespace Tourze\GetterSetterTrait\Tests\Fixtures;

use Tourze\GetterSetterTrait\Exception\InvalidPropertyValueException;
use Tourze\GetterSetterTrait\GetterTrait;
use Tourze\GetterSetterTrait\PropertyTrait;
use Tourze\GetterSetterTrait\SetterTrait;

/**
 * 测试用的具体类，实现了所有trait
 */
class IntegrationTestSubject
{
    use GetterTrait;
    use SetterTrait;
    use PropertyTrait;

    private string $name = '';

    private int $age = 0;

    /** @var array<string, mixed> */
    protected array $data = [];

    private bool $active = false;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $value): void
    {
        $this->name = trim($value);
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $value): void
    {
        if ($value < 0) {
            throw new InvalidPropertyValueException('Age cannot be negative');
        }
        $this->age = $value;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $value): void
    {
        $this->active = $value;
    }

    // 只读属性
    public function getReadOnly(): string
    {
        return 'read-only';
    }

    // 只写属性
    public function setWriteOnly(string $value): void
    {
        // 这是一个只写属性
    }

    // 计算属性
    public function getFullName(): string
    {
        return $this->name . ' (Age: ' . $this->age . ')';
    }
}
