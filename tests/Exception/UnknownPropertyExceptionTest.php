<?php

declare(strict_types=1);

namespace Tourze\GetterSetterTrait\Tests\Exception;

use PHPUnit\Framework\Attributes\CoversClass;
use Tourze\GetterSetterTrait\Exception\UnknownPropertyException;
use Tourze\PHPUnitBase\AbstractExceptionTestCase;

/**
 * @internal
 */
#[CoversClass(UnknownPropertyException::class)]
final class UnknownPropertyExceptionTest extends AbstractExceptionTestCase
{
    public function testCanBeCreated(): void
    {
        $message = 'Unknown property';
        $exception = new UnknownPropertyException($message);

        $this->assertInstanceOf(UnknownPropertyException::class, $exception);
        $this->assertInstanceOf(\Exception::class, $exception);
        $this->assertEquals($message, $exception->getMessage());
    }

    public function testCanBeCreatedWithCode(): void
    {
        $message = 'Unknown property';
        $code = 789;
        $exception = new UnknownPropertyException($message, $code);

        $this->assertEquals($message, $exception->getMessage());
        $this->assertEquals($code, $exception->getCode());
    }

    public function testCanBeCreatedWithPrevious(): void
    {
        $previous = new \Exception('Previous exception');
        $exception = new UnknownPropertyException('Unknown property', 0, $previous);

        $this->assertSame($previous, $exception->getPrevious());
    }
}
