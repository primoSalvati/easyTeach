<?php
namespace Controllers;

use \Template;


class UserController extends Controller
{

     public function renderLogin($f3)
    {
        $f3->set('pageTitle', 'Login');
        $f3->set('mainHeading', 'Login');
        $f3->set('content', 'Views/content/login.html');

        echo Template::instance()->render('/Views/index.html');
    }

    public function beforeroute()
    {
    }

    function authenticate($f3, $params)
    {

        if (isset($_POST['username']) and isset($_POST['password'])) {

            $gump = new \GUMP('en');

            // gump validates form entries upon these rules
            $gump->validation_rules(array(
                'username' => 'required|alpha_numeric|max_len,100|min_len,3',
                'password' => 'required|alpha_numeric|max_len,255|min_len,4',

            ));

            // further form entry sanitation
            $gump->filter_rules(array(
                'username' => 'trim|sanitize_string',
                'password' => 'trim',
            ));

            // initialize gump
            $validLoginData = $gump->run($_POST);

            // getting username and password from sent POST
            $username = $validLoginData['username'];
            $password = $validLoginData['password'];

            // Connect to server and select databse.
            $user = new \Models\UserModel($this->db);
            $result = $user->getUserCredentials($username, $password);
            if ($result !== false) {
                // start session and redirect to user dashboard
                // $this->customSessionStore('userId', $result);
                /* SH::customSessionStore('userId', $result); */
                // var_dump(SH::customSessionRead('userId'));
                // exit();
                $f3->reroute('/');
            } else {
                // redirect login
                // error
                $f3->set('values', $_POST);
                $f3->set('loginError', 'You have entered an invalid username or password');
                // $f3->reroute('/login');
                $f3->set('content', '/views/content/login.html');

                echo Template::instance()->render('/views/index.php');
            }
        }
    }
}
