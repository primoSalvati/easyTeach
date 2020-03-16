<?php
require_once 'vendor/autoload.php';
 
$f3 = \Base::instance();

/* 
if i want to use the config files instead of the settings we used in class

$f3->config('Config/config.ini');
$f3->config('Config/routes.ini'); 

*/
/* i decided to use config.ini to allow the cache, i couldn't find any documentation about an alternative way of allowing cache(for login system), please keep in mind that like that, autooad and routes are recalled in another way(from this document) */
$f3->config('Config/config.ini');

/* $f3->set('DEBUG', '3'); */




/* either i write the line below and, when recalling a view on the controllers, i only write the document name, OR i don't write the line below and on the controllers i write the path! */
/* $f3->set('UI', 'Views/'); */
/* $f3->set('AUTOLOAD', 'Controllers/'); */
require 'routes.php';
 
new Session();
 
$f3->run();