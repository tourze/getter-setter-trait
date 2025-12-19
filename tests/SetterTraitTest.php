<?php

declare(strict_types=1);

namespace Tourze\GetterSetterTrait\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tourze\GetterSetterTrait\Exception\InvalidCallException;
use Tourze\GetterSetterTrait\Exception\InvalidPropertyValueException;
use Tourze\GetterSetterTrait\Exception\UnknownPropertyException;
use Tourze\GetterSetterTrait\SetterTrait;
use Tourze\GetterSetterTrait\Tests\Fixtures\SetterTraitTestSubject;
use Tourze\PHPUnitSymfonyKernelTest\AbstractIntegrationTestCase;

/**
 * @internal
 */
#[CoversClass(SetterTrait::class)]
#[RunTestsInSeparateProcesses]
final class SetterTraitTest extends AbstractIntegrationTestCase
{
    protected function onSetUp(): void
    {
        // 此测试类不需要特殊的设置逻辑
    }

    /**
     * 用于测试的类，实现了SetterTrait
     */
    private function createTestClass(): SetterTraitTestSubject
    {
        return new SetterTraitTestSubject();
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
        $this->assertEquals($testData, $object->getData());
    }

    /**
     * 测试设置带验证的属性
     */
    public function testSetPropertyWithValidation(): void
    {
        $object = $this->createTestClass();

        $this->expectException(InvalidPropertyValueException::class);
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
