<?php

namespace Tourze\GetterSetterTrait\Tests;

use PHPUnit\Framework\TestCase;
use Tourze\GetterSetterTrait\Exception\InvalidCallException;
use Tourze\GetterSetterTrait\Exception\InvalidPropertyValueException;
use Tourze\GetterSetterTrait\Exception\UnknownPropertyException;
use Tourze\GetterSetterTrait\GetterTrait;
use Tourze\GetterSetterTrait\PropertyTrait;
use Tourze\GetterSetterTrait\SetterTrait;

class IntegrationTest extends TestCase
{
    /**
     * 创建用于测试的类，同时实现了所有trait
     */
    private function createTestClass()
    {
        return new class {
            use GetterTrait, SetterTrait, PropertyTrait;

            private string $name = '';
            private int $age = 0;
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
        };
    }

    /**
     * 测试属性读写的完整流程
     */
    public function testPropertyAccessFlow(): void
    {
        $object = $this->createTestClass();

        // 检查属性是否存在和可访问性
        $this->assertTrue($object->hasProperty('name'));
        $this->assertTrue($object->canGetProperty('name'));
        $this->assertTrue($object->canSetProperty('name'));

        $this->assertTrue($object->hasProperty('readOnly'));
        $this->assertTrue($object->canGetProperty('readOnly'));
        $this->assertFalse($object->canSetProperty('readOnly'));

        $this->assertTrue($object->hasProperty('writeOnly'));
        $this->assertFalse($object->canGetProperty('writeOnly'));
        $this->assertTrue($object->canSetProperty('writeOnly'));

        // 设置和获取属性值
        $object->name = ' John Doe ';  // 使用setter会进行trim处理
        $this->assertEquals('John Doe', $object->name);

        $object->age = 30;
        $this->assertEquals(30, $object->age);

        // 测试计算属性
        $this->assertEquals('John Doe (Age: 30)', $object->fullName);

        // 测试不标准的属性访问（isActive而不是getActive）
        $object->active = true;
        $this->assertTrue($object->isActive());
    }

    /**
     * 测试异常情况
     */
    public function testExceptionalCases(): void
    {
        $object = $this->createTestClass();

        // 测试未知属性
        $this->expectException(UnknownPropertyException::class);
        $value = $object->unknownProperty;
    }

    /**
     * 测试读取只写属性
     */
    public function testReadWriteOnlyProperty(): void
    {
        $object = $this->createTestClass();

        $this->expectException(InvalidCallException::class);
        $value = $object->writeOnly;
    }

    /**
     * 测试设置只读属性
     */
    public function testWriteReadOnlyProperty(): void
    {
        $object = $this->createTestClass();

        $this->expectException(InvalidCallException::class);
        $object->readOnly = 'new value';
    }

    /**
     * 测试设置带验证的属性
     */
    public function testPropertyValidation(): void
    {
        $object = $this->createTestClass();

        $this->expectException(InvalidPropertyValueException::class);
        $object->age = -1;
    }
}
