<?php

namespace Tourze\GetterSetterTrait\Tests;

use PHPUnit\Framework\TestCase;
use Tourze\GetterSetterTrait\Exception\InvalidCallException;
use Tourze\GetterSetterTrait\Exception\UnknownPropertyException;
use Tourze\GetterSetterTrait\GetterTrait;

class GetterTraitTest extends TestCase
{
    /**
     * 用于测试的类，实现了GetterTrait
     */
    private function createTestClass()
    {
        return new class {
            use GetterTrait;

            private string $name = 'test';
            private int $age = 25;
            private array $data = ['key' => 'value'];

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
        };
    }

    /**
     * 测试通过魔术方法访问标准属性
     */
    public function testGetProperty(): void
    {
        $object = $this->createTestClass();

        $this->assertEquals('test', $object->name);
        $this->assertEquals(25, $object->age);
        $this->assertEquals(100, $object->calculatedValue);
    }

    /**
     * 测试访问未定义的属性时抛出异常
     */
    public function testGetUnknownProperty(): void
    {
        $object = $this->createTestClass();

        $this->expectException(UnknownPropertyException::class);
        $object->unknownProperty;
    }

    /**
     * 测试访问只写属性时抛出异常
     */
    public function testGetWriteOnlyProperty(): void
    {
        $object = $this->createTestClass();

        $this->expectException(InvalidCallException::class);
        $object->secretKey;
    }
}
