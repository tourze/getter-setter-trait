<?php

namespace Tourze\GetterSetterTrait\Tests\Unit\Exception;

use PHPUnit\Framework\TestCase;
use Tourze\GetterSetterTrait\Exception\InvalidPropertyValueException;

class InvalidPropertyValueExceptionTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $message = 'Invalid property value';
        $exception = new InvalidPropertyValueException($message);
        
        $this->assertInstanceOf(InvalidPropertyValueException::class, $exception);
        $this->assertInstanceOf(\RuntimeException::class, $exception);
        $this->assertEquals($message, $exception->getMessage());
    }
    
    public function testCanBeCreatedWithCode(): void
    {
        $message = 'Invalid property value';
        $code = 456;
        $exception = new InvalidPropertyValueException($message, $code);
        
        $this->assertEquals($message, $exception->getMessage());
        $this->assertEquals($code, $exception->getCode());
    }
    
    public function testCanBeCreatedWithPrevious(): void
    {
        $previous = new \Exception('Previous exception');
        $exception = new InvalidPropertyValueException('Invalid value', 0, $previous);
        
        $this->assertSame($previous, $exception->getPrevious());
    }
}