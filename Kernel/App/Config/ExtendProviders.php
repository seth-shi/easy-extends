<?php

    // 5.3 版本不支持 \Kernel\App\Extensions::class
    return array(
        'redis'     => \Kernel\App\Extensions\Redis::class,
        'memcache'  => \Kernel\App\Extensions\Memcache::class,
        'xdebug'    => \Kernel\App\Extensions\Xdebug::class,
        'curl'      => \Kernel\App\Extensions\Curl::class,
        'openssl'   => \Kernel\App\Extensions\Openssl::class,
        'mongo'     => \Kernel\App\Extensions\Mongo::class,
        'mbstring'  => \Kernel\App\Extensions\Mbsring::class,
        'mongodb'   => \Kernel\App\Extensions\Mongodb::class,
        'gd'        => \Kernel\App\Extensions\Gd::class,
        'fileinfo'  => \Kernel\App\Extensions\Fileinfo::class,
        'mysqli'    => \Kernel\App\Extensions\Mysqli::class,
        'pdo-mysql' => \Kernel\App\Extensions\PDOmysql::class,
        'rollback'  => \Kernel\App\Extensions\Rollback::class
    );
