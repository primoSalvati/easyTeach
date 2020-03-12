<?php

namespace Controllers;


use \Template;

use function Models\debug_to_console;
use function Models\dump_and_die;
use function Models\dumpthisvalue;
use function Models\valOrNull;

class SettingsController
{
    public function index($f3, $params)
    {

        /* $sm = new \Models\StudentsModel();
        $students = $sm->students();
        $f3->set('students', $students);



        $f3->set('jScripts', ['/js/student.js']); */

        $f3->set('pageTitle', 'Settings');
        $f3->set('mainHeading', 'Settings');
        $f3->set('content', 'Views/content/settings/settings.html');

        echo Template::instance()->render('/Views/index.html');

    }
}
