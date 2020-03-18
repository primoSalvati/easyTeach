<?php

namespace Controllers;


use \Template;

use function Models\debug_to_console;
use function Models\dump_and_die;
use function Models\dumpthisvalue;
use function Models\valOrNull;

class SettingsController
{

    /**
     * selectBox this function is meant to fetch the data of foreign keys in the table students (in database). The function is defined here as protected and then recalled in other functions with the command $this->selectBox($f3);
     *
     * @param mixed $f3
     * 
     * @return void
     */
    protected function selectBox($f3)
    {
        $selectBox = new \Models\MultipleChoiceModel();

        $studentSources = $selectBox->studentSources();
        $inst = $selectBox->allInstruments();
        $lessonLength = $selectBox->lessonLength();
        $studentRegularity = $selectBox->studentRegularity();
        $eventTypes = $selectBox->eventTypes();


        /* This array function is meant to remove the value "Music Lesson" from the array, so that it won't show in the section gig. Necessary because otherwise the user can insert a lesson without a student, that will show up in lessons section with an empty student field */
        array_splice($eventTypes, 0, 1);


        $f3->set('event_types', $eventTypes);
        $f3->set('student_sources', $studentSources);
        $f3->set('instruments', $inst);
        $f3->set('lesson_length', $lessonLength);
        $f3->set('student_regularity', $studentRegularity);
    }


    /**
     * index the if statement is meant to assign a default value of display to the css tab "instruments", and in the every insert section, there is some code at the beginning that instruct the program to mantain the tab active after the post of the correponding values, without going back to the default tab "instruments"
     *
     * @param mixed $f3
     * 
     * @return void
     */
    public function index($f3)
    {

        $this->selectBox($f3);

        $f3->set('jScripts', ['/js/delete.js', '/js/settingsTabs.js']);

        /* $f3->set('activeTab', 'instruments'); */

        if (!$f3->get('activeTab')) {
            $f3->set('activeTab', 'instruments');
        }

        $f3->set('pageTitle', 'Settings');
        $f3->set('mainHeading', 'Settings');
        $f3->set('content', 'Views/content/settings/settings.html');

        echo Template::instance()->render('/Views/index.html');
    }


    /**
     * insertInstruments
     *
     * @param mixed $f3
     * 
     * @return void
     */
    public function insertInstruments($f3)
    {/* the code mentione in the index function documentation */
        $f3->set('activeTab', 'instruments');
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
                } else {
                    $f3->set('alertScript', 'alert(\'Error! Value couldn\'t be inserted.\');');
                }

                $this->selectBox($f3);
                $this->index($f3);
            }
        }
    }


    /**
     * deleteInstruments, like the following sections, takes the valie od the id variable in the url
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
    public function deleteInstruments($f3, $params)
    {
        $vid = $params['instrId'];
        if (!filter_var($vid, FILTER_VALIDATE_INT)) {
            echo 'Error: the value can\'t be canceled';
        } else {
            $sm = new \Models\SettingsModel();
            if ($sm->deleteInstrument($vid)) {
                echo 'Deleted';
            } else {
                echo 'Error';
            }
        }
    }







    /**
     * insertEventTypes
     *
     * @param mixed $f3
     * 
     * @return void
     */
    public function insertEventTypes($f3)
    {
        $f3->set('activeTab', 'event_types');
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
                } else {
                    $f3->set('alertScript', 'alert(\'Error! Value couldn\'t be inserted.\');');
                }
                $f3->set('activeTab', 'event_types');
                $this->selectBox($f3);
                $this->index($f3);
            }
        }
    }


    /**
     * deleteEventTypes
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
    public function deleteEventTypes($f3, $params)
    {
        $vid = $params['evTypeId'];
        if (!filter_var($vid, FILTER_VALIDATE_INT)) {
            echo 'Error: the value can\'t be canceled';
        } else {
            $sm = new \Models\SettingsModel();
            if ($sm->deleteEventType($vid)) {
                echo 'Deleted';
            } else {
                echo 'Error';
            }
        }
    }

    /**
     * insertStudentSources
     *
     * @param mixed $f3
     * 
     * @return void
     */
    public function insertStudentSources($f3)
    {
        $f3->set('activeTab', 'student_sources');
        if (!empty($_POST)) {
            $gump = new \GUMP('en');

            $gump->validation_rules(array(
                'student_sources' => 'required|min_len,2|max_len, 40',
            ));

            $gump->filter_rules(array(
                'student_sources' => 'trim|sanitize_string|htmlencode|noise_words',
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
                $StudentSourcesInserted = $sm->insertStudentSource($validData['student_sources']);



                if ($StudentSourcesInserted === true) {

                    $f3->set('alertScript', 'alert(\'Success! Value inserted.\');');
                } else {
                    $f3->set('alertScript', 'alert(\'Error! Value couldn\'t be inserted.\');');
                }

                $this->selectBox($f3);
                $this->index($f3);
            }
        }
    }

    /**
     * deleteStudentSources
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
    public function deleteStudentSources($f3, $params)
    {
        $ssid = $params['stSourceId'];
        if (!filter_var($ssid, FILTER_VALIDATE_INT)) {
            echo 'Error: the value can\'t be canceled';
        } else {
            $sm = new \Models\SettingsModel();
            if ($sm->deleteStudentSource($ssid)) {
                echo 'Deleted';
            } else {
                echo 'Error';
            }
        }
    }



    /**
     * insertLessonLengths
     *
     * @param mixed $f3
     * 
     * @return void
     */
    public function insertLessonLengths($f3)
    {


        if (!empty($_POST)) {
            $gump = new \GUMP('en');

            $gump->validation_rules(array(
                'lesson_length' => 'required|min_len,2|max_len, 40',
            ));

            $gump->filter_rules(array(
                /* if i put noisewords as filter, it cancles the value 2 (like 2 hours) */
                'lesson_length' => 'trim|sanitize_string',
            ));

            $validData = $gump->run($_POST);



            if ($validData === false) {
                $errors = $gump->get_errors_array();
                $f3->set('activeTab', 'lesson_length');
                $f3->set('errors', $errors);


                $f3->set('values', $_POST);


                $this->selectBox($f3);
                $this->index($f3);
            } else {
                $sm = new \Models\SettingsModel();
                $lessonLengthInserted = $sm->insertLessonLength($validData['lesson_length']);



                if ($lessonLengthInserted === true) {

                    $f3->set('alertScript', 'alert(\'Success! Value inserted.\');');
                } else {
                    $f3->set('alertScript', 'alert(\'Error! Value couldn\'t be inserted.\');');
                }
                $f3->set('activeTab', 'lesson_length');
                $this->selectBox($f3);
                $this->index($f3);
            }
        }
    }


    /**
     * deleteLessonLengths
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
    public function deleteLessonLengths($f3, $params)
    {
        $vid = $params['lesLenghId'];
        if (!filter_var($vid, FILTER_VALIDATE_INT)) {
            echo 'Error: the value can\'t be canceled';
        } else {
            $sm = new \Models\SettingsModel();
            if ($sm->deleteLessonLength($vid)) {
                echo 'Deleted';
            } else {
                echo 'Error';
            }
        }
    }



    /**
     * insertStudentRegularities
     *
     * @param mixed $f3
     * 
     * @return void
     */
    public function insertStudentRegularities($f3)
    {


        if (!empty($_POST)) {
            $gump = new \GUMP('en');

            $gump->validation_rules(array(
                'student_regularity' => 'required|min_len,2|max_len, 40',
            ));

            $gump->filter_rules(array(
                /* if i put noisewords as filter, it cancles the value 2 (like 2 hours) */
                'student_regularity' => 'trim|sanitize_string',
            ));

            $validData = $gump->run($_POST);



            if ($validData === false) {
                $errors = $gump->get_errors_array();
                $f3->set('activeTab', 'student_regularity');
                $f3->set('errors', $errors);


                $f3->set('values', $_POST);


                $this->selectBox($f3);
                $this->index($f3);
            } else {
                $sm = new \Models\SettingsModel();
                $studentRegularityInserted = $sm->insertStudentRegularity($validData['student_regularity']);



                if ($studentRegularityInserted === true) {

                    $f3->set('alertScript', 'alert(\'Success! Value inserted.\');');
                } else {
                    $f3->set('alertScript', 'alert(\'Error! Value couldn\'t be inserted.\');');
                }
                $f3->set('activeTab', 'student_regularity');
                $this->selectBox($f3);
                $this->index($f3);
            }
        }
    }


    /**
     * deleteStudentRegularities
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
    public function deleteStudentRegularities($f3, $params)
    {
        $vid = $params['stRegId'];
        if (!filter_var($vid, FILTER_VALIDATE_INT)) {
            echo 'Error: the value can\'t be canceled';
        } else {
            $sm = new \Models\SettingsModel();
            if ($sm->deleteStudentRegularity($vid)) {
                echo 'Deleted';
            } else {
                echo 'Error';
            }
        }
    }
}
