<?php

namespace Controllers;


use \Template;


class LessonsController
{
    /**
     * Shows the main page of the "Lessons" section, calling the buttons to go to the further sections
     *
     * @param [type] $f3
     * @param [type] $params
     * @return void
     */
    public function index($f3, $params)
    {

        $f3->set('pageTitle', 'Lessons');
        $f3->set('mainHeading', 'Lessons');
        $f3->set('content', 'Views/content/lessons/lessons.html');

        echo Template::instance()->render('/Views/index.html');
    }


    public function selectStudent($f3, $params)
    {

        $sm = new \Models\StudentsModel();
        $students = $sm->students();
        $f3->set('students', $students);
        /* TODO: maybe it's better to show the students details on a javascript alert, so that the application doesn't need to lead to another page */
        $f3->set('jScripts', ['/js/student.js']);

        $f3->set('pageTitle', 'Select Student');
        $f3->set('mainHeading', 'Select Student');
        $f3->set('content', 'Views/content/lessons/selectStudents.html');

        echo Template::instance()->render('/Views/index.html');
    }

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

            $f3->set('currentDate', date('Y-m-d'));
            $f3->set('currentTime', date('H:i'));
            $f3->set('values', $values);
            $f3->set('pageTitle', 'Insert lesson');
            $f3->set('mainHeading', 'Insert lesson');
            $f3->set('content', '/Views/content/lessons/lessonForm.html');

            echo Template::instance()->render('/Views/index.html');
        }
    }

    public function insertLesson($f3, $params)
    {
        if (!empty($_POST)) {
            $gump = new \GUMP('en');
/* TODO: important! when receiving the lesson form, i should see at least the last notes, or even have a link to a page with all notes from the one student! */
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

                /* var_dump($_POST); */

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


    public function lessonsList($f3, $params) {

        $lm = new \Models\LessonsModel();
        $lessons = $lm->lessons();
        $f3->set('lessons', $lessons);

        /* print_r($lessons); */

        /* $f3->set('jScripts', ['/js/student.js']); */

        $f3->set('pageTitle', 'Lessons List');
        $f3->set('mainHeading', 'Lessons List');
        $f3->set('content', 'Views/content/lessons/lessonsList.html');

        echo Template::instance()->render('/Views/index.html');

    }


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

/*         $f3->set('jScripts', ['/js/studentDetails.js']); */

        $f3->set('pageTitle', 'Lesson Details');
        $f3->set('mainHeading', 'Lesson Details');
        $f3->set('content', 'Views/content/lessons/lessonDetails.html');

        echo Template::instance()->render('/Views/index.html');
    }


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

            var_dump($values);

            echo Template::instance()->render('/Views/index.html');
        }
    }

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
                'name' => 'required|max_len, 50',
                'surname' => 'required|max_len, 50',
                'email'    => 'valid_email',
                'student_price'    => 'max_len, 4',
            ));
            $gump->filter_rules(array(
                'name' => 'trim|sanitize_string',
                'surname' => 'trim',
                'email'    => 'trim|sanitize_email',
                'phone'   => 'trim',
                'student_price'    => 'trim',
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
                $sm = new \Models\LessonsModel();
                $lessonUpdated = $sm->editStudent($validData['event_types_id'], $validData['students_id'],$validData['date'], $validData['time'], $validData['earning'], $validData['address'], $validData['notes'], $lid);

                if ($studentUpdated === true) {
                    $f3->set('alertSuccess', 'New student successfully updated!');
                } else {
                    $f3->set('alertError', 'Error! The student couldn\'t be updated.');
                }

                $f3->set('pageTitle', 'Students');
                $f3->set('mainHeading', 'Students');
                $f3->set('content', 'Views/content/students/studentInserted.html');

                echo Template::instance()->render('/Views/index.html');
            }
        }
    }








}