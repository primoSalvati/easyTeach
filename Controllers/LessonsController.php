<?php

namespace Controllers;


use \Template;

use function Models\debug_to_console;
use function Models\dump_and_die;
use function Models\dumpthisvalue;
use function Models\valOrNull;

class LessonsController 
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

        $lm = new \Models\LessonsModel();
        $lessons = $lm->lessons();
        $f3->set('lessons', $lessons);


        $f3->set('jScripts', ['/js/delete.js']);

        $f3->set('pageTitle', 'Lessons');
        $f3->set('mainHeading', 'Lessons');
        $f3->set('content', 'Views/content/lessons/lessonsList.html');

        echo Template::instance()->render('/Views/index.html');
    }


    /**
     * selectStudent, the function fetches information about students, stores them in the array $students, and returns them on a html table with students to be selected for a lesson, so that the lesson form can have information about students inside
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
    public function selectStudent($f3, $params)
    {

        $sm = new \Models\StudentsModel();
        $students = $sm->students();
        $f3->set('students', $students);
        $f3->set('jScripts', ['/js/delete.js']);

        $f3->set('pageTitle', 'Select Student');
        $f3->set('mainHeading', 'Select Student');
        $f3->set('content', 'Views/content/lessons/selectStudents.html');

        echo Template::instance()->render('/Views/index.html');
    }

    /**
     * lessonForm, given a student id from the previous page, the function gives the form some prepared information, like student name, played instrument, (default) current date and time, student price as earning, address (taken from student source, in case of a private student, there is a conversion to home, as specified below).
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
    public function lessonForm($f3, $params)
    {
        $sid = $params['sid'];
        if (!filter_var($sid, FILTER_VALIDATE_INT)) {
            $values = [];
        } else {
            $sm = new \Models\StudentsModel();
            $values = $sm->studentDetails($sid);

            $this->selectBox($f3);

            date_default_timezone_set('Europe/Vienna');
            /* This line is meant to have, in the address field, the value home for private students */
            $f3->set('address', $values['source'] === 'Private' ? $values['source'] = 'Home' : $values['source']);

            $f3->set('currentDate', !empty($_GET['date'])? $_GET['date']  : date('Y-m-d') );
            
            $f3->set('currentTime', date('H:i'));
            
            $f3->set('values', $values);

            /* dumpThisValue($values); */

            $f3->set('pageTitle', 'Insert lesson');
            $f3->set('mainHeading', 'Insert lesson');
            $f3->set('content', '/Views/content/lessons/lessonForm.html');

            echo Template::instance()->render('/Views/index.html');
        }
    }

    /**
     * insertLesson, similar to insertStudent(), with GUMP validation
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
    public function insertLesson($f3, $params)
    {
        if (!empty($_POST)) {
            $gump = new \GUMP('en');


        
            $gump->validation_rules(array(
                'date' => 'required|date',
                'time' => 'required',
                'earning' => 'numeric',
                'address' => 'max_len, 50',
                'notes' => 'max_len, 2500',
                'links' => 'valid_url',
            ));
            
            $gump->filter_rules(array(
                'earning' => 'trim|sanitize_string',
                'address' => 'trim|sanitize_string',
                'notes' => 'sanitize_string',
                'files' => 'sanitize_string',
                'links' => 'trim|sanitize_string',
            ));

            $validData = $gump->run($_POST);



            if ($validData === false) {
                $errors = $gump->get_errors_array();
                $f3->set('errors', $errors);

                $f3->set('values', $_POST);


                date_default_timezone_set('Europe/Vienna');

                $this->selectBox($f3);

                $f3->set('currentDate', date('Y-m-d'));
                $f3->set('currentTime', date('H:i'));

                $f3->set('pageTitle', 'Insert lesson');
                $f3->set('mainHeading', 'Insert lesson');
                $f3->set('content', '/Views/content/lessons/lessonForm.html');

                echo Template::instance()->render('/Views/index.html');

            } else {
                $lm = new \Models\LessonsModel();
                $lessonInserted = $lm->insertLesson($validData['event_types_id'], $validData['students_id'],$validData['date'], $validData['time'], $validData['earning'], $validData['address'], $validData['notes']);


                if ($lessonInserted === true) {
                    $f3->set('alertSuccess', 'New lesson successfully inserted!');
                } else {
                    $f3->set('alertError', 'Error! The lesson couldn\'t be inserted.');
                }

                $f3->set('pageTitle', 'Lessons');
                $f3->set('mainHeading', 'Lessons');
                $f3->set('content', 'Views/content/lessons/lessonInserted.html');

                echo Template::instance()->render('/Views/index.html');
            }
        }
    }




    /**
     * lessonDetails, the function fetches the details of a lesson. Additionally, it the earning field is empty, it will be shown as 0 
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
    public function lessonDetails($f3, $params)
    {
        $lid = $params['lid'];
        // Nur Ganzzahlen sind erlaubt
        if (!filter_var($lid, FILTER_VALIDATE_INT)) {
            $lessonDetails = [];
        } else {
            $lm = new \Models\LessonsModel();
            $lessonDetails = $lm->lessonDetails($lid);
        }



        if ($lessonDetails['earning'] === '') {
            $lessonDetails['earning'] = 0;
        }


        $f3->set('lessonDetails', $lessonDetails);


        $f3->set('pageTitle', 'Lesson Details');
        $f3->set('mainHeading', 'Lesson Details');
        $f3->set('content', 'Views/content/lessons/lessonDetails.html');

        echo Template::instance()->render('/Views/index.html');
    }


    /**
     * getCompiledForm, to edit a lesson, gets the lesson's data and assigns some of them to the lesson form with the array $values
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
    public function getCompiledForm($f3, $params)
    {
        $lid = $params['lid'];
        if (!filter_var($lid, FILTER_VALIDATE_INT)) {
            $values = [];
        } else {
            $sm = new \Models\LessonsModel();
            $values = $sm->lessonDetails($lid);

            $this->selectBox($f3);

            $f3->set('values', $values);
            $f3->set('pageTitle', 'Edit Lesson');
            $f3->set('mainHeading', 'Edit Lesson');
            $f3->set('content', '/Views/content/lessons/lessonForm.html');


            echo Template::instance()->render('/Views/index.html');
        }
    }

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

        $studentList = $selectBox->studentList();
        $inst = $selectBox->allInstruments();
        $lessonLength = $selectBox->lessonLength();
        
        $f3->set('student_list', $studentList);
        $f3->set('instruments', $inst);
        $f3->set('lesson_length', $lessonLength);
        

    }



    /**
     * editLesson updates the data from the form, changing the current values
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
        public function editLesson($f3, $params)
    {
        $lid = $params['lid'];
        if (!filter_var($lid, FILTER_VALIDATE_INT)) {
            $values = [];
        } else {
            $lm = new \Models\LessonsModel();
            $values = $lm->lessonDetails($lid);
        }
        
        if (!empty($_POST)) {
            $gump = new \GUMP('en');

           
            $gump->validation_rules(array(
                'date' => 'required|date',
                'time' => 'required',
                'earning' => 'required|numeric',
                'address' => 'max_len, 50',
                'notes' => 'max_len, 2500',
                'links' => 'valid_url',
            ));

            $gump->filter_rules(array(
                'earning' => 'trim|sanitize_string',
                'address' => 'trim|sanitize_string',
                'notes' => 'sanitize_string',
                'files' => 'sanitize_string',
                'links' => 'trim|sanitize_string',
            ));

            $validData = $gump->run($_POST);

            
            if ($validData === false) {
                $errors = $gump->get_errors_array();
                $f3->set('errors', $errors);

                $f3->set('values', $_POST);

                $this->selectBox($f3);

                $f3->set('pageTitle', 'Edit Lesson');
                $f3->set('mainHeading', 'Edit Lesson');
                $f3->set('content', 'Views/content/lessons/lessonForm.html');

                echo Template::instance()->render('/Views/index.html');
                
            } else {
                $lm = new \Models\LessonsModel();
                $lessonUpdated = $lm->editLesson($validData['students_id'], $validData['date'], $validData['time'], $validData['earning'], $validData['address'], $validData['notes'], $lid);
 
                if ($lessonUpdated === true) {
                    $f3->set('alertSuccess', 'Lesson successfully updated!');
                } else {
                    $f3->set('alertError', 'Error! The lesson couldn\'t be updated.');
                }

                $f3->set('pageTitle', 'Lessons');
                $f3->set('mainHeading', 'Lessons');
                $f3->set('content', 'Views/content/lessons/lessonInserted.html');

                echo Template::instance()->render('/Views/index.html');
            }
        }
    }


    /**
     * deleteLesson, given the id in $params
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
    public function deleteLesson($f3, $params)
    {
        $lid = $params['lid'];
        if (!filter_var($lid, FILTER_VALIDATE_INT)) {
            echo 'Error: the lesson can\'t be canceled';
        } else {
            $lm = new \Models\LessonsModel();
            if ($lm->deleteLesson($lid)) {
                echo 'Deleted';
            } else {
                echo 'Error';
            }
        }
    }





}
