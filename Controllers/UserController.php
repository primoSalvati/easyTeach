<?php

namespace Controllers;

use function Models\debug_to_console;
use function Models\dump_and_die;
use function Models\dumpthisvalue;
use function Models\valOrNull;
use \Template;


class UserController extends Controller
{

    public function index($f3, $params)
    {
/*         $username = $this->f3->get('POST.username');
        if ($this->authenticate() === true) {
            $f3->set('login', 'Welcome' . $username);
        } else {
            $f3->set('login', 'Login');
        } */
        $f3->set('pageTitle', 'Login');
        $f3->set('mainHeading', 'Login');
        $f3->set('content', 'Views/content/login.html');

        echo Template::instance()->render('/Views/index.html');
    }

    public function authenticate()
    {

        // getting username and password from sent POST
        $username = $this->f3->get('POST.username');
        $password = $this->f3->get('POST.password');


        $user = new \Models\UserModel($this->db);
        $user->getByName($username);

        // see if user exists
        if ($user->dry()) {
            $this->f3->reroute('/login');
        }

        // see if password match
        if (password_verify($password, $user->password)) {
            $this->f3->set('SESSION.user', $user->username);
            $this->f3->reroute('/');
        } else {
            $this->f3->reroute('/login');
        }
    }

    function beforeroute()
    {
    } 

}