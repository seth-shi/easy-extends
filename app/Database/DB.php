<?php

namespace DavidNineRoc\EasyExtends\Database;


class DB
{
    protected static $tables = [];

    public static function table($table = 'sections')
    {
        if (! self::hasTable($table)) {
            self::$tables[$table] = new Table($table);
        }

        return self::$tables[$table];
    }

    public static function hasTable($table)
    {
        return isset(self::$tables[$table]);
    }
}