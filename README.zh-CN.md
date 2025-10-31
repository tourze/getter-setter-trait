# getter-setter-trait

[English](README.md) | [中文](README.zh-CN.md)

[![最新稳定版本](https://poser.pugx.org/tourze/getter-setter-trait/v/stable)](https://packagist.org/packages/tourze/getter-setter-trait)
[![构建状态](https://github.com/tourze/getter-setter-trait/workflows/CI/badge.svg)](https://github.com/tourze/getter-setter-trait/actions)
[![许可证](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![PHP 版本](https://img.shields.io/badge/php-%5E8.1-blue)](https://www.php.net/)
[![覆盖率状态](https://coveralls.io/repos/github/tourze/getter-setter-trait/badge.svg)](https://coveralls.io/github/tourze/getter-setter-trait)

一个轻量级的 PHP Trait 库，提供可复用的 Getter 和 Setter 魔术方法，兼容 Yii2 风格异常处理，让对象属性的访问更加安全、简洁和自动化。

## 功能特性

- 通过 Trait 快速集成 getter/setter 魔术方法
- 兼容 Yii2 风格的属性访问异常处理
- 自动检测 getter/setter 方法
- 支持属性存在性检查
- 面向 PHP 8.1 及以上版本

## 安装说明

需要 PHP 8.1 及以上版本。

使用 Composer 安装：

```bash
composer require tourze/getter-setter-trait
```

## 快速开始

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

## 详细文档

- **GetterTrait**：实现 `__get($name)` 魔术方法用于属性读取。
- **SetterTrait**：实现 `__set($name, $value)` 魔术方法用于属性写入。
- **PropertyTrait**：提供 `hasProperty`、`canGetProperty`、`canSetProperty` 等辅助方法。
- 对于未定义属性抛出 `UnknownPropertyException`，对于只读/只写属性抛出 `InvalidCallException`（兼容 Yii2）。

### 高级用法

- 可自定义 getter/setter 方法实现特殊逻辑。
- 使用 `PropertyTrait` 可编程判断属性可访问性。

## 贡献指南

欢迎任何贡献！

- 如有 bug 或新需求，请提交 Issue。
- Fork 本仓库并通过 Pull Request 提交更改。
- 提交前请确保代码风格规范并通过测试。
- 遵循 [PSR-12](https://www.php-fig.org/psr/psr-12/) 编码规范。

## 版权和许可

本项目基于 MIT 协议开源，详见 [LICENSE](LICENSE) 文件。

## 作者

tourze 团队

---

> 本 README 基于实际代码生成，并严格遵循项目文档规范。
