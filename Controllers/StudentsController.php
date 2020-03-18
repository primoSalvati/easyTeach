<?php

namespace Controllers;
use function Models\debug_to_console;
use function Models\dump_and_die;
use function Models\dumpthisvalue;
use function Models\valOrNull;
use \Template;

/* TODO: insert the possibility to have active students, and a student archive, possibly with buttons to reactivate or delete them */



class StudentsController 
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

        $sm = new \Models\StudentsModel();
        $students = $sm->students();
        $f3->set('students', $students);


        $f3->set('jScripts', ['/js/delete.js']);

        $f3->set('pageTitle', 'Students');
        $f3->set('mainHeading', 'Students');
        $f3->set('content', 'Views/content/students/showStudents.html');

        echo Template::instance()->render('/Views/index.html');
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

        $studentSources = $selectBox->studentSources();
        $inst = $selectBox->allInstruments();
        $lessonLength = $selectBox->lessonLength();
        $studentRegularity = $selectBox->studentRegularity();

        

        $f3->set('student_sources', $studentSources);
        $f3->set('instruments', $inst);
        $f3->set('lesson_length', $lessonLength);
        $f3->set('student_regularity', $studentRegularity);
    }

    /**
     * getForm, recalls the page with the student form, and gives it, through the command $this->selectBox($f3), values for the select boxes
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
    public function getForm($f3, $params)
    {
        $this->selectBox($f3);

        $f3->set('pageTitle', 'Add Student');
        $f3->set('mainHeading', 'Add Student');
        $f3->set('content', '/Views/content/students/studentForm.html');

        echo Template::instance()->render('/Views/index.html');
    }


    /**
     * postForm after the validation with the class GUMP (imported from gitHub), it inserts students with student model function and redirects to a success/failure page
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
    public function postForm($f3, $params)
    {
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

                $f3->set('pageTitle', 'Students');
                $f3->set('mainHeading', 'Students');
                $f3->set('content', 'Views/content/students/studentForm.html');

                echo Template::instance()->render('/Views/index.html');
            } else {
                $sm = new \Models\StudentsModel();
                $studentInserted = $sm->addStudent($validData['name'], $validData['surname'], $validData['email'], $validData['phone'], $validData['date_of_birth'], $validData['student_price'], $validData['student_source'], $validData['instrument'], $validData['lesson_length'], $validData['student_regularity']);


                if ($studentInserted === true) {
                    $f3->set('alertSuccess', 'New student successfully inserted!');
                } else {
                    $f3->set('alertError', 'Error! The student couldn\'t be inserted.');
                }

                $f3->set('pageTitle', 'Students');
                $f3->set('mainHeading', 'Students');
                $f3->set('content', 'Views/content/students/studentInserted.html');

                echo Template::instance()->render('/Views/index.html');
            }
        }
    }


    /**
     * getCompiledForm, to edit a student, gets the student's data and assigns some of them to the student form with the array $values
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
    public function getCompiledForm($f3, $params)
    {
        $sid = $params['sid'];
        if (!filter_var($sid, FILTER_VALIDATE_INT)) {
            $values = [];
        } else {
            $sm = new \Models\StudentsModel();
            $values = $sm->studentDetails($sid);

            $this->selectBox($f3);
            
            $f3->set('values', $values);
            $f3->set('pageTitle', 'Edit Student');
            $f3->set('mainHeading', 'Edit Student');
            $f3->set('content', '/Views/content/students/studentForm.html');

            echo Template::instance()->render('/Views/index.html');
        }
    
    }

    /**
     * editStudent, insert the data from the form, changing the current values
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
    public function editStudent($f3, $params)
    {
        $sid = $params['sid'];
        if (!filter_var($sid, FILTER_VALIDATE_INT)) {
            $values = [];
        } else {
            $sm = new \Models\StudentsModel();
            $values = $sm->studentDetails($sid);
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

                $f3->set('pageTitle', 'Edit Student');
                $f3->set('mainHeading', 'Edit Student');
                $f3->set('content', 'Views/content/students/studentForm.html');

                echo Template::instance()->render('/Views/index.html');
                
            } else {
                $sm = new \Models\StudentsModel();
                $studentUpdated = $sm->editStudent($validData['name'], $validData['surname'], $validData['email'], $validData['phone'], $validData['date_of_birth'], $validData['student_price'], $validData['student_source'], $validData['instrument'], $validData['lesson_length'], $validData['student_regularity'], $sid);

                if ($studentUpdated === true) {
                    $f3->set('alertSuccess', 'Student successfully updated!');
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


    
    /**
     * studentDetails, the student price can be setted as empty, and if empty, it will be shown as 0
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
    public function studentDetails($f3, $params)
    {
        $sid = $params['sid'];
        // Nur Ganzzahlen sind erlaubt
        if (!filter_var($sid, FILTER_VALIDATE_INT)) {
            $studentDetails = [];
        } else {
            $sm = new \Models\StudentsModel();
            $studentDetails = $sm->studentDetails($sid);
        }


        if ($studentDetails['student_price'] === '') {
            $studentDetails['student_price'] = 0;
        }
       

        $f3->set('studentDetails', $studentDetails);

        $f3->set('pageTitle', 'Student Details');
        $f3->set('mainHeading', 'Student Details');
        $f3->set('content', 'Views/content/students/studentDetails.html');

        echo Template::instance()->render('/Views/index.html');
    }


 
    
    /**
     * deleteStudent
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
    public function deleteStudent($f3, $params)
    {
        $sid = $params['sid'];
        if (!filter_var($sid, FILTER_VALIDATE_INT)) {
            echo 'Error: the student can\'t be canceled';
        } else {
            $sm = new \Models\StudentsModel();
            if ($sm->deleteStudent($sid)) {
                echo 'Deleted';
            } else {
                echo 'Error';
            }
        }
    }
}
