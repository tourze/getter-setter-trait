# getter-setter-trait

[English](README.md) | [中文](README.zh-CN.md)

[![Latest Stable Version](https://poser.pugx.org/tourze/getter-setter-trait/v/stable)](https://packagist.org/packages/tourze/getter-setter-trait)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![PHP Version](https://img.shields.io/badge/php-%5E8.1-blue)](https://www.php.net/)
[![Coverage Status](https://coveralls.io/repos/github/tourze/getter-setter-trait/badge.svg)](https://coveralls.io/github/tourze/getter-setter-trait)

A lightweight PHP library providing reusable Getter and Setter traits for object property access, inspired by Yii2 conventions. 
It enables magic property access (`__get`, `__set`) with robust exception handling for unknown or write/read-only properties.

## Features

- Simple integration of getter/setter magic methods via traits
- Yii2-style exception handling for property access
- Automatic detection of getter/setter methods
- Support for property existence checks
- Designed for PHP 8.1+

## Installation

Requires PHP 8.1 or higher.

Install via Composer:

```bash
composer require tourze/getter-setter-trait
```

## Quick Start

```php
use Tourze\GetterSetterTrait\GetterTrait;
use Tourze\GetterSetterTrait\SetterTrait;
use Tourze\GetterSetterTrait\PropertyTrait;

class User
{
    use GetterTrait, SetterTrait, PropertyTrait;

    private string $name = '';

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}

$user = new User();
$user->name = 'Tom';
echo $user->name; // Tom
```

## Documentation

- **GetterTrait**: Implements `__get($name)` for magic property reading.
- **SetterTrait**: Implements `__set($name, $value)` for magic property writing.
- **PropertyTrait**: Provides `hasProperty`, `canGetProperty`, `canSetProperty` helpers.
- Throws `UnknownPropertyException` for undefined properties, `InvalidCallException` for read/write-only properties (compatible with Yii2).

### Advanced Usage

- You may override getter/setter methods for custom logic.
- Use `PropertyTrait` to check property accessibility programmatically.

## Contributing

Contributions are welcome! Please follow these steps:

- Submit issues for bugs or feature requests.
- Fork the repository and create pull requests.
- Ensure code style and run tests before submitting.
- Follow [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standards.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Author

tourze Team

---

> This README is generated based on the actual codebase and follows the project documentation rules.
