<?php
    if(!defined('BASEPATH')) exit('No direct script access allowed');
    
    if(!function_exists('app_baseurl'))
    {
        function app_baseurl()
        {
            $app_baseurl = base_url().'index.php?/';
            return $app_baseurl;
        }
    }
?>
