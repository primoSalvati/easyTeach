<?php

namespace Controllers;


use \Template;

use function Models\debug_to_console;
use function Models\dump_and_die;
use function Models\dumpthisvalue;
use function Models\valOrNull;

class SettingsController 
{

    public function index($f3)
    {

        $this->selectBox($f3);
        
        $f3->set('jScripts', ['/js/settingsTabs.js', '/js/delete.js']);
       

        $f3->set('pageTitle', 'Settings');
        $f3->set('mainHeading', 'Settings');
        $f3->set('content', 'Views/content/settings/settings.html');

        echo Template::instance()->render('/Views/index.html');
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
/* nota: credo solo a causa della validierung fallita, debbo creare diverse funzioni di insert */
    public function insertInstrument($f3)
    {
        if (!empty($_POST)) {
            $gump = new \GUMP('en');

            $gump->validation_rules(array(
                'instrument' => 'required|min_len,2|max_len, 40',
            ));

            $gump->filter_rules(array(
                'instrument' => 'trim|sanitize_string|htmlencode|noise_words',
            ));

            $validData = $gump->run($_POST);



            if ($validData === false) {
                $errors = $gump->get_errors_array();
                $f3->set('errors', $errors);
            
                $f3->set('values', $_POST);


                $this->selectBox($f3);
                $this->index($f3);

            } else {
                $sm = new \Models\SettingsModel();
                $instrumentInserted = $sm->insertInstrument($validData['instrument']);



                if ($instrumentInserted === true) {
                  
                    $f3->set('alertScript', 'alert(\'Success! Value inserted.\');');
                 
                } 
                 else {
                    $f3->set('alertScript', 'alert(\'Error! Value couldn\'t be inserted.\');');
                }
                $this->selectBox($f3);
                $this->index($f3);
            }
        }
    }





    public function insertEventTypes($f3)
    {
        if (!empty($_POST)) {
            $gump = new \GUMP('en');

            $gump->validation_rules(array(
                'event_types'    => 'required|min_len,4|max_len, 40',
            ));

            $gump->filter_rules(array(
                'event_types'    => 'trim|sanitize_string',
            ));

            $validData = $gump->run($_POST);



            if ($validData === false) {
                $errors = $gump->get_errors_array();
                $f3->set('errors', $errors);
                
                $f3->set('values', $_POST);


                $this->selectBox($f3);
                $this->index($f3);

            } else {
                $sm = new \Models\SettingsModel();
                $eventTypeInserted = $sm->insertEventType($validData['event_types']);

                if ($eventTypeInserted === true) {
                
                    $f3->set('alertScript', 'alert(\'Success! Value inserted.\');');
                  
                } 
                 else {
                    $f3->set('alertScript', 'alert(\'Error! Value couldn\'t be inserted.\');');
                }
                $this->selectBox($f3);
                $this->index($f3);
            }
        }
    }

    public function insertStudentSources($f3)
    {
        if (!empty($_POST)) {
            $gump = new \GUMP('en');

            $gump->validation_rules(array(
                'student_sources'    => 'required|min_len,4|max_len, 40',
                /*                 'student_sources' => 'min_len,2|max_len, 40',
                'event_types'    => 'min_len,4|max_len, 40',
                'student_regularity'    => 'min_len,4|max_len, 40',
                'lesson_length'    => 'min_len,4|max_len, 40', */
            ));

            $gump->filter_rules(array(
                'student_sources'    => 'trim|sanitize_string',
                /*                 'student_sources' => 'trim|sanitize_string',
                'event_types'    => 'trim|sanitize_string',
                'student_regularity' => 'trim|sanitize_string',
                'lesson_length'    => 'trim|sanitize_string', */
            ));

            $validData = $gump->run($_POST);



            if ($validData === false) {
                $errors = $gump->get_errors_array();
                $f3->set('errors', $errors);

                $f3->set('values', $_POST);


                $this->selectBox($f3);
                $this->index($f3);

            } else {
                $sm = new \Models\SettingsModel();
                $studentSourcesInserted = $sm->insertStudentSource($validData['student_sources']);

                if ($studentSourcesInserted === true) {

                    $f3->set('alertScript', 'alert(\'Success! Value inserted.\');');
                } else {
                    $f3->set('alertScript', 'alert(\'Error! Value couldn\'t be inserted.\');');
                }
                $this->selectBox($f3);
                $this->index($f3);
            }
        }
    }

    public function deleteValue($f3, $params)
    {
        $vid = $params['valueid'];
        if (!filter_var($vid, FILTER_VALIDATE_INT)) {
            echo 'Error: the value can\'t be canceled';
        } else {
            $sm = new \Models\SettingsModel();
            if ($sm->deleteInstrument($vid)) {
                echo 'Deleted';
            } elseif ($sm->deleteEventType($vid)) {
                echo 'Deleted';
            } elseif ($sm->deleteStudentSource($vid)) {
                echo 'Deleted';
            } elseif ($sm->deleteLessonLength($vid)) {
                echo 'Deleted';
            } elseif ($sm->deleteStudentRegularity($vid)) {
                echo 'Deleted';
            } else {
                echo 'Error';
            }
        }
    }






}
