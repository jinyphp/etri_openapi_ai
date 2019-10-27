<?php
/*
 * This file is part of the jinyPHP package.
 *
 * (c) hojinlee <infohojin@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Etri\OpenAi;

if(function_exists("accesskey")) {
    function accesskey()
    {
        $path = "access_key.php";
        for($i=0;$i<5;$i++) {
            if(file_exists($path)){
                return include $path;
            }

            $path = "../".$path;
        }
    }
}
