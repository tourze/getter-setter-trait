<?php

declare(strict_types=1);

namespace Tourze\GetterSetterTrait\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tourze\GetterSetterTrait\PropertyTrait;
use Tourze\GetterSetterTrait\Tests\Fixtures\PropertyTraitTestSubject;
use Tourze\PHPUnitSymfonyKernelTest\AbstractIntegrationTestCase;

/**
 * @internal
 */
#[CoversClass(PropertyTrait::class)]
#[RunTestsInSeparateProcesses]
final class PropertyTraitTest extends AbstractIntegrationTestCase
{
    protected function onSetUp(): void
    {
        // 此测试类不需要特殊的设置逻辑
    }

    /**
     * 用于测试的类，实现了PropertyTrait
     */
    private function createTestClass(): PropertyTraitTestSubject
    {
        return new PropertyTraitTestSubject();
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
