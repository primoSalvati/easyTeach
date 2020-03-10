<?php

namespace Controllers;

use \Template;

use function Models\dumpthisvalue;

class GigController
{


    protected function selectBox($f3)
    {
        $selectBox = new \Models\MultipleChoiceModel();

        $eventTypes = $selectBox->eventTypes();

        $f3->set('event_types', $eventTypes);
    }

    public function gigForm($f3, $params)
    {
        $this->selectBox($f3);


        /* $message = "Ol";
        echo "<script type='text/javascript'>alert('$message');</script>"; */

        date_default_timezone_set('Europe/Vienna');

        $f3->set('currentDate', date('Y-m-d'));
        $f3->set('currentTime', date('H:i'));

        $f3->set('pageTitle', 'New Gig');
        $f3->set('mainHeading', 'New Gig');
        $f3->set('content', '/Views/content/gig/gigForm.html');

        echo Template::instance()->render('/Views/index.html');
    }

    public function insertGig($f3, $params)
    {
        if (!empty($_POST)) {
        
        $gump = new \GUMP('en');

        $gump->validation_rules(array(
                'date' => 'required|date',
                'time' => 'required',
                'earning' => 'required|numeric',
                'address' => 'max_len, 50',
                'notes' => 'max_len, 2500',
            )); 
        $gump->filter_rules(array(
                'earning' => 'trim|sanitize_string',
                'address' => 'trim|sanitize_string',
                'notes' => 'sanitize_string',
            )); 
            $validData = $gump->run($_POST);

            if ($validData === false) {
                $errors = $gump->get_errors_array();
                $this->selectBox($f3);
                $f3->set('errors', $errors);
                $f3->set('values', $_POST);


                date_default_timezone_set('Europe/Vienna');

                $f3->set('currentDate', date('Y-m-d'));
                $f3->set('currentTime', date('H:i'));

                $f3->set('pageTitle', 'New Gig');
                $f3->set('mainHeading', 'New Gig');
                $f3->set('content', '/Views/content/gig/gigForm.html');

                echo Template::instance()->render('/Views/index.html');

            } else {
                $gm = new \Models\GigModel();
                $gigInserted = $gm->insertGig($validData['date'], $validData['time'], $validData['address'], $validData['earning'], $validData['event_types_id'], $validData['notes']);


                if ($earningInserted === true) {


                    /* $message = "New gig successfully inserted!";
                    echo "<script type='text/javascript'>alert('$message');</script>"; */ 
                    /* $f3->set('alertSuccess', 'New earning successfully inserted!'); */
                } else {

                    /* $message = "Error! The gig couldn't be inserted.";
                    echo "<script type='text/javascript'>alert('$message');</script>";  */
                    /* $f3->set('alertError', 'Error! The earning couldn\'t be inserted.'); */

                    /* to display the success with a better javascript alert, todo also for students detail and lesson details */
                    /* $f3->set('jScripts', ['/js/earningAlert.js']); */
                }





        $f3->set('pageTitle', 'New Gig');
        $f3->set('mainHeading', 'New Gig');
        $f3->set('content', '/Views/content/gig/gigForm.html');

        echo Template::instance()->render('/Views/index.html');
            }
        }
    }
}
