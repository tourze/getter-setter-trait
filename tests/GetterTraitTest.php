<?php

declare(strict_types=1);

namespace Tourze\GetterSetterTrait\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tourze\GetterSetterTrait\Exception\InvalidCallException;
use Tourze\GetterSetterTrait\Exception\UnknownPropertyException;
use Tourze\GetterSetterTrait\GetterTrait;
use Tourze\GetterSetterTrait\Tests\Fixtures\GetterTraitTestSubject;
use Tourze\PHPUnitSymfonyKernelTest\AbstractIntegrationTestCase;

/**
 * @internal
 */
#[CoversClass(GetterTrait::class)]
#[RunTestsInSeparateProcesses]
final class GetterTraitTest extends AbstractIntegrationTestCase
{
    protected function onSetUp(): void
    {
        // 此测试类不需要特殊的设置逻辑
    }

    /**
     * 用于测试的类，实现了GetterTrait
     */
    private function createTestClass(): GetterTraitTestSubject
    {
        return new GetterTraitTestSubject();
    }

    /**
     * 测试通过魔术方法访问标准属性
     */
    public function testGetProperty(): void
    {
        $object = $this->createTestClass();

        $this->assertEquals('test', $object->name); // @phpstan-ignore-line
        $this->assertEquals(25, $object->age); // @phpstan-ignore-line
        $this->assertEquals(100, $object->calculatedValue); // @phpstan-ignore-line
    }

    /**
     * 测试访问未定义的属性时抛出异常
     */
    public function testGetUnknownProperty(): void
    {
        $object = $this->createTestClass();

        $this->expectException(UnknownPropertyException::class);
        $value = $object->unknownProperty; // @phpstan-ignore-line
    }

    /**
     * 测试访问只写属性时抛出异常
     */
    public function testGetWriteOnlyProperty(): void
    {
        $object = $this->createTestClass();

        $this->expectException(InvalidCallException::class);
        $value = $object->secretKey; // @phpstan-ignore-line
    }
}
