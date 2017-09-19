# WaitMoonMan/EasyExtends

## 一键简易安装PHP扩展

## Feature
    - 一键安装PHP扩展
    - 命令行安装
    - 界面安装
    - 回滚 php.ini 文件


# Extended Support
* redis
* memecache
* rollback
## Requirement

1. PHP >= 5.3



## Installation

```shell
composer require waitmoonman/easy-extends
```

## Usage

```php
// CLI => install redis 第一次安装可能会出错，再执行一次便可
php install.php redis
// 如果写入失败, 请回滚 php.ini 文件
php install.php rollback
```    

## License

MIT
