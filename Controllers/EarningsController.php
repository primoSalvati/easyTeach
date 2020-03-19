<?php

namespace Controllers;

use \Template;

use function Models\dumpthisvalue;

class EarningsController
{

    /**
     * display total earnings, additional features explained in the comments inside the function
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
    public function display($f3, $params)
    {

        $data = new \Models\EarningsModel();

        $totalEarnings = $data->earningsTotal();


        /* older version: extract the values from the array earning and sum them */
        /*         $sum = 0;
        foreach ($totalEarnings as $array) {
            $sum += $array["earning"];
        } */



        $this->selectBox($f3);

        /* here is the logic to keep the values of the dates visible after the submission, and have a default current date in both fields */
        date_default_timezone_set('Europe/Vienna');
        $f3->set('startDate', !empty($_POST['startDate']) ? $_POST['startDate'] : date('Y-m-d'));
        $f3->set('endDate', !empty($_POST['endDate']) ? $_POST['endDate']  : date('Y-m-d'));

        $f3->set('sum', $totalEarnings[0]['total']);
        $f3->set('pageTitle', 'Earnings');
        $f3->set('mainHeading', 'Earnings');
        $f3->set('content', 'Views/content/earnings/displayEarnings.html');

        echo Template::instance()->render('/Views/index.html');
    }

    /**
     * filterOptions, filters first the general $_POST, and in specific, checs if the radio button are used as filters, passing the values in case of if==true
     *
     * @param mixed $f3
     * @param mixed $params
     * 
     * @return void
     */
    public function filterOptions($f3, $params)
    {

        if (!empty($_POST)) {
            $studentSourcesId = null;
            $eventTypesId = null;

            if (!empty($_POST['singleSelect'])) {
                $studentSourcesId = $_POST['studentSourceId'];
                $f3->set('selected_source', $studentSourcesId);
                $eventTypesId = $_POST['eventTypeId'];
                $f3->set('selected_eventType', $eventTypesId);
                /* 
            if (!empty($_POST['selectByGigs'])) {
                $eventTypesId = $_POST['eventTypeId'];
                $f3->set('selected_eventType', $eventTypesId);
            } */

                /* $studentSourcesId = $_POST['studentSourceId']; */
                $startDate = $_POST['startDate'];
                $endDate = $_POST['endDate'];
                /* $eventTypesId = $_POST['eventTypeId']; */

                $data = new \Models\EarningsModel();

                $totalEarnings = $data->earningsFiltered($_POST['singleSelect'], $studentSourcesId, $eventTypesId, $startDate, $endDate);

                /* dumpthisvalue($totalEarnings); */


                $f3->set('sum', $totalEarnings[0]['total']);
            } else {
                $f3->set('sum', 0);
            }

            $this->selectBox($f3);


            $f3->set('singleSelect', $_POST['singleSelect']);
            $f3->set('startDate', $startDate);
            $f3->set('endDate', $endDate);




            $f3->set('pageTitle', 'Earnings');
            $f3->set('mainHeading', 'Earnings');
            $f3->set('content', 'Views/content/earnings/displayEarnings.html');

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

        $studentSources = $selectBox->studentSources();
        $eventTypes = $selectBox->eventTypes();
        /* This array function is meant to remove the value "Music Lesson" from the array, so that it won't show in the section gig. Necessary because otherwise the user can insert a lesson without a student, that will show up in lessons section with an empty student field */
        array_splice($eventTypes, 0, 1);
        $f3->set('student_sources', $studentSources);
        $f3->set('event_types', $eventTypes);
    }
}
