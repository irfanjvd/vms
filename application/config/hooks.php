<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/


$hook['post_controller_constructor'] = array(
        'class'    => 'My_gatekeeper',
        'function' => 'requestLogger',
        'filename' => 'My_gatekeeper.php',
        'filepath' => 'hooks',
        'params'   => ""
);
