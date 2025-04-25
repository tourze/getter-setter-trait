<?php

namespace Tourze\GetterSetterTrait\Tests;

use PHPUnit\Framework\TestCase;
use Tourze\GetterSetterTrait\PropertyTrait;

class PropertyTraitTest extends TestCase
{
    /**
     * 用于测试的类，实现了PropertyTrait
     */
    private function createTestClass()
    {
        return new class {
            use PropertyTrait;

            private string $name = 'test';
            private int $age = 25;
            protected array $data = ['key' => 'value'];

            // 只读属性
            public function getName(): string
            {
                return $this->name;
            }

            // 标准getter和setter
            public function getAge(): int
            {
                return $this->age;
            }

            public function setAge(int $age): void
            {
                $this->age = $age;
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
        };
    }

    /**
     * 测试hasProperty方法
     */
    public function testHasProperty(): void
    {
        $object = $this->createTestClass();

        // 通过getter存在的属性
        $this->assertTrue($object->hasProperty('name'));

        // 通过getter和setter存在的属性
        $this->assertTrue($object->hasProperty('age'));

        // 通过类成员存在的属性
        $this->assertTrue($object->hasProperty('data'));

        // 只通过getter存在的计算属性
        $this->assertTrue($object->hasProperty('calculatedValue'));

        // 只通过setter存在的属性
        $this->assertTrue($object->hasProperty('secretKey'));

        // 不存在的属性
        $this->assertFalse($object->hasProperty('nonExistentProperty'));

        // 测试checkVars参数
        $this->assertTrue($object->hasProperty('data', true));
        $this->assertFalse($object->hasProperty('data', false));
    }

    /**
     * 测试canGetProperty方法
     */
    public function testCanGetProperty(): void
    {
        $object = $this->createTestClass();

        // 通过getter存在的属性
        $this->assertTrue($object->canGetProperty('name'));

        // 通过getter存在的属性
        $this->assertTrue($object->canGetProperty('age'));

        // 通过类成员存在的属性
        $this->assertTrue($object->canGetProperty('data'));

        // 只通过getter存在的计算属性
        $this->assertTrue($object->canGetProperty('calculatedValue'));

        // 只通过setter存在的属性
        $this->assertFalse($object->canGetProperty('secretKey'));

        // 不存在的属性
        $this->assertFalse($object->canGetProperty('nonExistentProperty'));

        // 测试checkVars参数
        $this->assertTrue($object->canGetProperty('data', true));
        $this->assertFalse($object->canGetProperty('data', false));
    }

    /**
     * 测试canSetProperty方法
     */
    public function testCanSetProperty(): void
    {
        $object = $this->createTestClass();

        // 只通过getter存在的属性（但name是一个private属性，所以checkVars=true时也可以设置）
        $this->assertTrue($object->canSetProperty('name', true));
        $this->assertFalse($object->canSetProperty('name', false));

        // 通过setter存在的属性
        $this->assertTrue($object->canSetProperty('age'));

        // 通过类成员存在的属性
        $this->assertTrue($object->canSetProperty('data'));

        // 只通过getter存在的计算属性
        $this->assertFalse($object->canSetProperty('calculatedValue'));

        // 只通过setter存在的属性
        $this->assertTrue($object->canSetProperty('secretKey'));

        // 不存在的属性
        $this->assertFalse($object->canSetProperty('nonExistentProperty'));

        // 测试checkVars参数
        $this->assertTrue($object->canSetProperty('data', true));
        $this->assertFalse($object->canSetProperty('data', false));
    }
}
