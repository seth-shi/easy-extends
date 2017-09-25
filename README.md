# WaitMoonMan/easy-extends
![语言](https://img.shields.io/badge/language-php-green.svg)
![协议](https://img.shields.io/badge/license-MIT-008800.svg)
[![博客](https://img.shields.io/badge/blog-@waitmoonman-blue.svg)](https://waitmoonman.github.io/)
[![下载](https://img.shields.io/badge/download-link-0000aa.svg)](https://github.com/waitmoonman/easy-extends/archive/master.zip)

## About
```
+--------------+                    +----------------+            +------------+
| open service | php install redis  | down redis.dll | php index  |    show    |
|  lamp/lnmp   |------------------> | move redis.dll | ---------> | extensions |
| environment  |                    | update php.ini |            |    list    |
+--------------+                    +----------------+            +------------+
```
![下载redis](http://or2pofbfh.bkt.clouddn.com/github/easy_extends_down_redis.gif)

## Requirement
1. PHP >= 5.3

## Installation
[easy-extends压缩包](https://github.com/waitmoonman/easy-extends/archive/master.zip)
```shell
// 手动下载
github 的 Clone or download 按钮 -> download zip 即可下载压缩包

// composer安装
composer require waitmoonman/easy-extends
```
## Usage
```php
// 使用格式
php install xxxx

// 安装 redis 扩展
php install redis
// 安装好了之后,查看开启的扩展
php index

// 如果写入失败, 请回滚 php.ini 文件
php install rollback
```    
## Support
* curl
* fileinfo
* gd2
* pdo-mssql
* pdo-mysql
* pdo-sqlite
* mbstring
* memcache
* mongo
* mongodb
* mysqli
* mssql
* openssl
* sphinx
* redis
* sockets
* solr
* ssh2
* xdebug
* zip

* rollback
## Errors
* php 既不是内部命令也不知可执行程序
    * 需注册[php环境变量](http://blog.shiguopeng.cn/article/10201.html)
* fwrite 写入失败
    * 需要给`\cache`文件夹配置读写权限，windows通常情况下默认是有的
* xxxx.dll already run
    * 已经安装了此扩展，且已在运行
## License
MIT