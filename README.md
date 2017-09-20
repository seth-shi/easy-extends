# WaitMoonMan/EasyExtends

## About
![redis一键安装](http://or2pofbfh.bkt.clouddn.com/github/easy_extends_down_redis.gif)
```
+--------------+                    +----------------+            +------------+
| open service | php install redis  | down redis.dll | php index  |    show    |
|  lamp/lnmp   |------------------> | move redis.dll | ---------> | extensions |
| environment  |                    | update php.ini |            |    list    |
+--------------+                    +----------------+            +------------+
```
1. 开启服务环境
2. php install redis  // 安装 redis 扩展
3. 程序会自动找到对应 PHP, NTS, VC, WIN 的扩展压缩文件之后进行下载,解压，移动到 php\ext 目录下, 并在 php.ini 文件开启扩展
4. php index          // 查看所有已开启扩展列表 !!! 请务必重启服务器

## Requirement
1. PHP >= 5.3

## Installation
```shell
composer require waitmoonman/easy-extends
```
## Usage
```php
/**
 * 在根目录打开命令行窗口, 需要有 PHP 环境 (在命令行下输入 php -v 可执行便是成功)
 */
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
## License
MIT