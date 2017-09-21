<?php

    // 5.3 版本不支持 '\Kernel\App\Extensions::class'
    return array(
        'redis'      => '\Kernel\App\Extensions\Redis',
        'memcache'   => '\Kernel\App\Extensions\Memcache',
        'xdebug'     => '\Kernel\App\Extensions\Xdebug',
        'curl'       => '\Kernel\App\Extensions\Curl',
        'openssl'    => '\Kernel\App\Extensions\Openssl',
        'mongo'      => '\Kernel\App\Extensions\Mongo',
        'mbstring'   => '\Kernel\App\Extensions\Mbsring',
        'mongodb'    => '\Kernel\App\Extensions\Mongodb',
        'gd'         => '\Kernel\App\Extensions\Gd',
        'fileinfo'   => '\Kernel\App\Extensions\Fileinfo',
        'mysqli'     => '\Kernel\App\Extensions\Mysqli',
        'pdo-mysql'  => '\Kernel\App\Extensions\PDOmysql',
        'pdo-mssql'  => '\Kernel\App\Extensions\PDOsqlsrv',
        'pdo-sqlite' => '\Kernel\App\Extensions\PDOsqlite',
        'sockets'    => '\Kernel\App\Extensions\Sockets',
        'zip'        => '\Kernel\App\Extensions\Zip',
        'mssql'      => '\Kernel\App\Extensions\Sqlsrv',
        'solr'       => '\Kernel\App\Extensions\Solr',
        'ssh2'       => '\Kernel\App\Extensions\Ssh2',
        'rollback'   => '\Kernel\App\Extensions\Rollback'
    );
