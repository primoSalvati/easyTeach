<?php
require_once 'vendor/autoload.php';
 
$f3 = \Base::instance();

/* 
if i want to use the config files instead of the settings we used in class

$f3->config('Config/config.ini');
$f3->config('App/Config/routes.ini'); 

*/

$f3->set('DEBUG', '3');
/* is this right to enable cache like that? */
$f3->set('CACHE', true);



/* either i write the line below and, when recalling a view on the controllers, i only write the document name, OR i don't write the line below and on the controllers i write the path! */
/* $f3->set('UI', 'Views/'); */
/* $f3->set('AUTOLOAD', 'Controllers/'); */
require 'routes.php';
 
new Session();
 
$f3->run();