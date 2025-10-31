<?php

declare(strict_types=1);

namespace Tourze\GetterSetterTrait\Tests\Exception;

use PHPUnit\Framework\Attributes\CoversClass;
use Tourze\GetterSetterTrait\Exception\InvalidCallException;
use Tourze\PHPUnitBase\AbstractExceptionTestCase;

/**
 * @internal
 */
#[CoversClass(InvalidCallException::class)]
final class InvalidCallExceptionTest extends AbstractExceptionTestCase
{
    public function testCanBeCreated(): void
    {
        $message = 'Test exception message';
        $exception = new InvalidCallException($message);

        $this->assertInstanceOf(InvalidCallException::class, $exception);
        $this->assertInstanceOf(\BadMethodCallException::class, $exception);
        $this->assertEquals($message, $exception->getMessage());
    }

    public function testCanBeCreatedWithCode(): void
    {
        $message = 'Test exception message';
        $code = 123;
        $exception = new InvalidCallException($message, $code);

        $this->assertEquals($message, $exception->getMessage());
        $this->assertEquals($code, $exception->getCode());
    }

    public function testCanBeCreatedWithPrevious(): void
    {
        $previous = new \Exception('Previous exception');
        $exception = new InvalidCallException('Test exception', 0, $previous);

        $this->assertSame($previous, $exception->getPrevious());
    }
}
