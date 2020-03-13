<?php

namespace Controllers;


use \Template;

use function Models\debug_to_console;
use function Models\dump_and_die;
use function Models\dumpthisvalue;
use function Models\valOrNull;

class SettingsController
{


    /* chiamare la funzione __construct? vedere se funziona anche mettendola sopre */
    public function index($f3)
    {

        /* $sm = new \Models\StudentsModel();
        $students = $sm->students();
        $f3->set('students', $students);*/
        $im = new \Models\MultipleChoiceModel();
        $instruments = $im->allInstruments();
        $f3->set('instruments', $instruments);

        $this->insertInstrument($f3);



        $f3->set('jScripts', ['/js/student.js']);

        $f3->set('pageTitle', 'Settings');
        $f3->set('mainHeading', 'Settings');
        $f3->set('content', 'Views/content/settings/settings.html');

        echo Template::instance()->render('/Views/index.html');
    }

    public function insertInstrument($f3)
    {
        if (!empty($_POST)) {
            $gump = new \GUMP('en');

            $gump->validation_rules(array(
                'addInstrument' => 'min_len,2|max_len, 40',
                'student_sources' => 'min_len,2|max_len, 40',
                'event_types'    => 'min_len,4|max_len, 40',
                'student_regularity'    => 'min_len,4|max_len, 40',
                'lesson_length'    => 'min_len,4|max_len, 40',
            ));

            $gump->filter_rules(array(
                'addInstrument' => 'trim|sanitize_string',
                'student_sources' => 'trim|sanitize_string',
                'event_types'    => 'trim|sanitize_string',
                'student_regularity' => 'trim|sanitize_string',
                'lesson_length'    => 'trim|sanitize_string',
            ));

            $validData = $gump->run($_POST);



            if ($validData === false) {
                $errors = $gump->get_errors_array();
                $f3->set('errors', $errors);
                /* achtung! assegnare con un or l'alternativa values ai valori ? */
                $f3->set('values', $_POST);

               /*  dumpthisvalue($_POST); */

                $this->selectBox($f3);

                $f3->set('pageTitle', 'Settings');
                $f3->set('mainHeading', 'Settings');
                $f3->set('content', 'Views/content/settings/settings.html');

                echo Template::instance()->render('/Views/index.html');
            } else {
                $sm = new \Models\SettingsModel();
                $valuesInserted = $sm->insertInstrument($validData['addInstrument']);




                if ($valuesInserted === true) {
                    $f3->set('alertSuccess', 'New value successfully inserted!');
                } else {
                    $f3->set('alertError', 'Error! The value couldn\'t be inserted.');
                }

                $f3->set('pageTitle', 'Settings');
                $f3->set('mainHeading', 'Settings');
                $f3->set('content', 'Views/content/settings/settings.html');

                echo Template::instance()->render('/Views/index.html');
            }
        }
    }




    protected function selectBox($f3)
    {
        $selectBox = new \Models\MultipleChoiceModel();

        $studentSources = $selectBox->studentSources();
        $inst = $selectBox->allInstruments();
        $lessonLength = $selectBox->lessonLength();
        $studentRegularity = $selectBox->studentRegularity();
        $eventTypes = $selectBox->eventTypes();


        $f3->set('event_types', $eventTypes);
        $f3->set('student_sources', $studentSources);
        $f3->set('instruments', $inst);
        $f3->set('lesson_length', $lessonLength);
        $f3->set('student_regularity', $studentRegularity);
    }
}
