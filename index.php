<?php
define('URL',str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" :
        "http")."://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]" ));
const ABSPATH = __DIR__;
require_once ('controllers/Router.php');

$router = new Router();
$router->routeReq();

