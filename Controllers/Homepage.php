<?php

namespace Controllers;

use \Template;


class Homepage 
{

  /**
   * index
   *
   * @param mixed $f3
   * @param mixed $params
   * 
   * @return void
   */
  public function index($f3, $params)
  {
    // https://fatfreeframework.com/3.6/framework-variables
    // Diese drei Variablen müssen immer gesetzt werden
    $f3->set('pageTitle', 'Home');
    $f3->set('mainHeading', 'easyTeach');
    $f3->set('content', '/Views/content/home.html');

    // Template ausgeben
    echo Template::instance()->render('/Views/index.html');
  }
  
}
