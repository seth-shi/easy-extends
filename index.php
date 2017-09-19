<?php

if (php_sapi_name() === 'cli')
{
    print_r(get_loaded_extensions(true));
}
else
{
    echo '<pre>';
    print_r(get_loaded_extensions(false));
    echo '<pre/>';
}