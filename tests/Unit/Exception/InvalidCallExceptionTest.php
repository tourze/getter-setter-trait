<?php

namespace Tourze\GetterSetterTrait\Tests\Unit\Exception;

use PHPUnit\Framework\TestCase;
use Tourze\GetterSetterTrait\Exception\InvalidCallException;

class InvalidCallExceptionTest extends TestCase
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