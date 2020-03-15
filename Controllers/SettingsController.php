<?php

namespace Controllers;


use \Template;

use function Models\debug_to_console;
use function Models\dump_and_die;
use function Models\dumpthisvalue;
use function Models\valOrNull;

class SettingsController 
{


    /* chiamare la funzione __construct? */
    public function index($f3)
    {

        $im = new \Models\MultipleChoiceModel();
        $instruments = $im->allInstruments();
        $f3->set('instruments', $instruments);

        $this->insertValue($f3);
        /* $this->deleteValue($f3, $params); */



        $f3->set('jScripts', ['/js/settingsTabs.js']);

        $f3->set('pageTitle', 'Settings');
        $f3->set('mainHeading', 'Settings');
        $f3->set('content', 'Views/content/settings/settings.html');

        echo Template::instance()->render('/Views/index.html');
    }

    public function insertValue($f3)
    {
        if (!empty($_POST)) {
            $gump = new \GUMP('en');

            $gump->validation_rules(array(
                'instrument' => 'required|min_len,2|max_len, 40',
/*                 'student_sources' => 'min_len,2|max_len, 40',
                'event_types'    => 'min_len,4|max_len, 40',
                'student_regularity'    => 'min_len,4|max_len, 40',
                'lesson_length'    => 'min_len,4|max_len, 40', */
            ));

            $gump->filter_rules(array(
                'instrument' => 'trim|sanitize_string|htmlencode|noise_words',
/*                 'student_sources' => 'trim|sanitize_string',
                'event_types'    => 'trim|sanitize_string',
                'student_regularity' => 'trim|sanitize_string',
                'lesson_length'    => 'trim|sanitize_string', */
            ));

            $validData = $gump->run($_POST);



            if ($validData === false) {
                $errors = $gump->get_errors_array();
                $f3->set('errors', $errors);
                /* achtung! assegnare con un or l'alternativa values ai valori ? */
                $f3->set('values', $_POST);

                /* dumpthisvalue($_POST); */

                $this->selectBox($f3);

                $f3->set('pageTitle', 'Settings');
                $f3->set('mainHeading', 'Settings');
                $f3->set('content', 'Views/content/settings/settings.html');

                echo Template::instance()->render('/Views/index.html');
            } else {
                $sm = new \Models\SettingsModel();
                $instrumentInserted = $sm->insertInstrument($validData['instrument']);
                dumpthisvalue($_POST);



                if ($instrumentInserted === true) {
                    /* $f3->set('alertSuccess', 'New value successfully inserted!'); */
                    $f3->set('alertScript', 'alert(\'Success! Value inserted.\');');
                    /* $f3->set('alertScript', 'foo'); */
                } else {
                    $f3->set('alertScript', 'alert(\'Error! Value couldn\'t be inserted.\');');
                }
                $this->selectBox($f3);
                $f3->set('jScripts', ['/js/settingsTabs.js']);
                $f3->set('pageTitle', 'Settings');
                $f3->set('mainHeading', 'Settings');
                $f3->set('content', 'Views/content/settings/settings.html');

                echo Template::instance()->render('/Views/index.html');
            }
        }
    }


    protected function deleteValue($f3, $params)
    {
        $vid = $params['vid'];
        if (!filter_var($vid, FILTER_VALIDATE_INT)) {
            echo 'Error: the valuet can\'t be canceled';
        } else {
            $sm = new \Models\SettingsModel();
            if ($sm->deleteInstrument($vid)) {
                echo 'Deleted';
            } else {
                echo 'Error';
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
