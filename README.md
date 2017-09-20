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
1. 开启服务环境
2. `php install redis  // 安装 redis 扩展`
3. 程序会自动找到对应 `PHP`, `NTS`, `VC`, `WIN` 的扩展压缩文件之后进行下载,解压，移动到`php\ext`目录下, 并在`php.ini`文件开启扩展
4. `php index          // 查看所有已开启扩展列表 !!! 请务必重启服务器`

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
// 安装好了之后， 请重启服务器再查看, 也可以使用 phpinfo(); 函数
php index

// 如果写入失败, 请回滚 php.ini 文件
php install rollback
```    
## Support
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
## Errors
* php 既不是内部命令也不知可执行程序
    * 需注册[php环境变量](http://blog.shiguopeng.cn/article/10201.html)
* fwrite 写入失败
    * 需要给`\cache`文件夹配置读写权限，windows通常情况下默认是有的
* xxxx.dll already run
    * 已经安装了此扩展，且已在运行
## License
MIT