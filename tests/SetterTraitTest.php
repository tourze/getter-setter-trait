<?php

namespace Tourze\GetterSetterTrait\Tests;

use PHPUnit\Framework\TestCase;
use Tourze\GetterSetterTrait\SetterTrait;
use yii\base\InvalidCallException;
use yii\base\UnknownPropertyException;

class SetterTraitTest extends TestCase
{
    /**
     * 用于测试的类，实现了SetterTrait
     */
    private function createTestClass()
    {
        return new class {
            use SetterTrait;

            private string $name = '';
            private int $age = 0;
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
                    throw new \InvalidArgumentException('Age cannot be negative');
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
            public function setData(array $value): void
            {
                $this->data = $value;
            }
        };
    }

    /**
     * 测试通过魔术方法设置标准属性
     */
    public function testSetProperty(): void
    {
        $object = $this->createTestClass();

        $object->name = 'John';
        $this->assertEquals('John', $object->getName());

        $object->age = 30;
        $this->assertEquals(30, $object->getAge());

        $testData = ['foo' => 'bar'];
        $object->data = $testData;
        // 无法直接访问私有属性，这里我们没有办法验证，除非增加 getter
    }

    /**
     * 测试设置带验证的属性
     */
    public function testSetPropertyWithValidation(): void
    {
        $object = $this->createTestClass();

        $this->expectException(\InvalidArgumentException::class);
        $object->age = -1;
    }

    /**
     * 测试设置未定义属性时抛出异常
     */
    public function testSetUnknownProperty(): void
    {
        $object = $this->createTestClass();

        $this->expectException(UnknownPropertyException::class);
        $object->unknownProperty = 'test';
    }

    /**
     * 测试设置只读属性时抛出异常
     */
    public function testSetReadOnlyProperty(): void
    {
        $object = $this->createTestClass();

        $this->expectException(InvalidCallException::class);
        $object->readOnly = 'new value';
    }
}
