<?php

    // 5.3 版本不支持 '\Kernel\App\Extensions::class'
    return array(
        'curl'       => '\Kernel\App\Extensions\Curl',
        'fileinfo'   => '\Kernel\App\Extensions\Fileinfo',
        'gd2'        => '\Kernel\App\Extensions\Gd',
        'pdo-mssql'  => '\Kernel\App\Extensions\PDOsqlsrv',
        'pdo-mysql'  => '\Kernel\App\Extensions\PDOmysql',
        'pdo-sqlite' => '\Kernel\App\Extensions\PDOsqlite',
        'mbstring'   => '\Kernel\App\Extensions\Mbsring',
        'memcache'   => '\Kernel\App\Extensions\Memcache',
        'mongo'      => '\Kernel\App\Extensions\Mongo',
        'mongodb'    => '\Kernel\App\Extensions\Mongodb',
        'mysqli'     => '\Kernel\App\Extensions\Mysqli',
        'mssql'      => '\Kernel\App\Extensions\Sqlsrv',
        'openssl'    => '\Kernel\App\Extensions\Openssl',
        'redis'      => '\Kernel\App\Extensions\Redis',
        'sockets'    => '\Kernel\App\Extensions\Sockets',
        'solr'       => '\Kernel\App\Extensions\Solr',
        'ssh2'       => '\Kernel\App\Extensions\Ssh2',
        'xdebug'     => '\Kernel\App\Extensions\Xdebug',
        'zip'        => '\Kernel\App\Extensions\Zip',

        'rollback'   => '\Kernel\App\Extensions\Rollback'
    );
