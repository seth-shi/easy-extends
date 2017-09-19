# WaitMoonMan/EasyExtends

## 一键简易安装PHP扩展

## Feature
    - 一键安装PHP扩展
    - 命令行安装
    - 界面安装
    - 回滚 php.ini 文件


# Extended Support
* redis
* memcache
* xdebug
* curl
* openssl
* mongo
* mbstring
* mongodb
* gd
* fileinfo
* mysqli
* pdo-mysql
* sockets
* zip
* mssql
* pdo-mssql
* rollback
## Requirement

1. PHP >= 5.3



## Installation

```shell
composer require waitmoonman/easy-extends
```

## Usage

```php
// 在根目录打开命令行窗口, 执行一下命令安装 redis 扩展
php install redis
// 如果写入失败, 请回滚 php.ini 文件
php install rollback
```    

## License

MIT
