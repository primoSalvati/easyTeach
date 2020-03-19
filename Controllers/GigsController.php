<?php

namespace Controllers;

use \Template;


use function Models\debug_to_console;
use function Models\dump_and_die;
use function Models\dumpthisvalue;
use function Models\valOrNull;

class GigsController 
{
    /**
     * index, show the list of gigs in a table where the user can see details edit and delete each one
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
    public function index($f3, $params)
    {

        $gm = new \Models\GigsModel();
        $gigs = $gm->gigs();
        $f3->set('gigs', $gigs);



        $f3->set('jScripts', ['/js/delete.js']);

        $f3->set('pageTitle', 'Gigs');
        $f3->set('mainHeading', 'Gigs');
        $f3->set('content', 'Views/content/gigs/showGigs.html');

        echo Template::instance()->render('/Views/index.html');
    }


    /**
     * selectBox selectBox this function is meant to fetch the data of foreign keys in the table students (in database). The function is defined here as protected and then recalled in other functions with the command $this->selectBox($f3);
     *
     * @param mixed $f3
     * 
     * @return void
     */
    protected function selectBox($f3)
    {
        $selectBox = new \Models\MultipleChoiceModel();

        $eventTypes = $selectBox->eventTypes();
        /* This array function is meant to remove the value "Music Lesson" from the array, so that it won't show in the section gig. Necessary because otherwise the user can insert a lesson without a student, that will show up in lessons section with an empty student field */
        array_splice($eventTypes, 0, 1);

        $f3->set('event_types', $eventTypes);
    }

    /**
     * gigForm shows a gig form, takes the values of the select box from the function above (filtered without the music lesson), and gives it a default current date and time
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
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
        $f3->set('content', '/Views/content/gigs/gigForm.html');

        echo Template::instance()->render('/Views/index.html');
    }

    /**
     * insertGig, similar style to insert student, or insert lesson
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
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
                $f3->set('content', '/Views/content/gigs/gigForm.html');

                echo Template::instance()->render('/Views/index.html');
            } else {
                $gm = new \Models\GigsModel();
                $gigInserted = $gm->insertGig($validData['date'], $validData['time'], $validData['address'], $validData['earning'], $validData['event_types_id'], $validData['notes']);



                if ($gigInserted === true) {

                    $f3->set('alertSuccess', 'New gig successfully inserted!');
                } else {

                    $f3->set('alertError', 'Error! The gig couldn\'t be inserted.');

                }


                $f3->set('pageTitle', 'New Gig');
                $f3->set('mainHeading', 'New Gig');
                $f3->set('content', '/Views/content/gigs/gigInserted.html');

                echo Template::instance()->render('/Views/index.html');
            }
        }
    }

    /**
     * gigDetails similar style to  student details, or  lesson details
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
    public function gigDetails($f3, $params)
    {
        $gid = $params['gid'];
        // Nur Ganzzahlen sind erlaubt
        if (!filter_var($gid, FILTER_VALIDATE_INT)) {
            $gigDetails = [];
        } else {
            $gm = new \Models\GigsModel();
            $gigDetails = $gm->gigDetails($gid);
        }


        $f3->set('gigDetails', $gigDetails);


        $f3->set('pageTitle', 'Gig Details');
        $f3->set('mainHeading', 'Gig Details');
        $f3->set('content', 'Views/content/gigs/gigDetails.html');

        echo Template::instance()->render('/Views/index.html');
    }

    /**
     * getCompiledForm similar style of other getCompiledForm functions, present in students and lessons Controllers
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
    public function getCompiledForm($f3, $params)
    {
        $gid = $params['gid'];
        if (!filter_var($gid, FILTER_VALIDATE_INT)) {
            $values = [];
        } else {
            $gm = new \Models\GigsModel();
            $values = $gm->gigDetails($gid);

            $this->selectBox($f3);

            $f3->set('values', $values);
            $f3->set('pageTitle', 'Edit Gig');
            $f3->set('mainHeading', 'Edit Gig');
            $f3->set('content', '/Views/content/gigs/gigForm.html');


            echo Template::instance()->render('/Views/index.html');
        }
    }

    /**
     * editGig similar style to edit student, or edit lesson
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
    public function editGig($f3, $params)
    {
        $gid = $params['gid'];
        if (!filter_var($gid, FILTER_VALIDATE_INT)) {
            $values = [];
        } else {
            $gm = new \Models\GigsModel();
            $values = $gm->gigDetails($gid);
        }

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
                $f3->set('errors', $errors);

                $f3->set('values', $_POST);

                $this->selectBox($f3);

                $f3->set('pageTitle', 'Edit Gig');
                $f3->set('mainHeading', 'Edit Gig');
                $f3->set('content', 'Views/content/gigs/gigForm.html');

                echo Template::instance()->render('/Views/index.html');
            } else {
                $gm = new \Models\GigsModel();
                $gigUpdated = $gm->editGig($validData['event_types_id'], $validData['earning'], $validData['date'], $validData['time'], $validData['address'], $validData['notes'], $gid);

                if ($gigUpdated === true) {
                    $f3->set('alertSuccess', 'Gig successfully updated!');
                } else {
                    $f3->set('alertError', 'Error! The gig couldn\'t be updated.');
                }

                $f3->set('pageTitle', 'Gigs');
                $f3->set('mainHeading', 'Gigs');
                $f3->set('content', 'Views/content/gigs/gigInserted.html');

                echo Template::instance()->render('/Views/index.html');
            }
        }
    }

    /**
     * deleteGig, given the id
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
    public function deleteGig($f3, $params)
    {
        $gid = $params['gid'];
        if (!filter_var($gid, FILTER_VALIDATE_INT)) {
            echo 'Error: the gig can\'t be canceled';
        } else {
            $gm = new \Models\GigsModel();
            if ($gm->deleteGig($gid)) {
                echo 'Deleted';
            } else {
                echo 'Error';
            }
        }
    }
}
