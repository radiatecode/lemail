<?php
/**
 * Created by PhpStorm.
 * User: dark007
 * Date: 2/10/2019
 * Time: 12:11 PM
 */
if (! function_exists('customAsset')){
    function customAsset($path , $secure =null){
        $mode = "offline";
        $full_path = "";
        if ($mode=="online"){
            $full_path = "public/".$path;
        }else if ($mode=="offline"){
            $full_path = $path;
        }
        return app('url')->asset($full_path, $secure);
    }
}