<?php

namespace Controllers;

use \Template;

class Controller 
{

    // function is called before every single routing!
    function beforeroute()
    {
        function beforeroute()
        {
            if ($this->f3->get('SESSION.user') === null) {
                $this->f3->reroute('/login');
                exit;
            }
    }

    // function is called after every single routing!
/*     function afterroute()
    {
    } */
}

}
