<?php
/**
 * Created by PhpStorm.
 * User: admin-mxp
 * Date: 2019/7/19
 * Time: 15:05
 */


function te () {
    print_r(error_get_last());
    echo "s=11";
}

register_shutdown_function("te");

echo "before";
$a = new a();
echo "after";