<?php

namespace Controllers;

use \Template;

class Controller
{

    // this function is called before every single routing
    public function beforeroute()
    {
        if ($this->f3->get('SESSION.user') === null) {
            $this->f3->reroute('/login');
            exit;
        }
    }

    // this function is called after every single routing
    function afterroute()
    {
    }
}
