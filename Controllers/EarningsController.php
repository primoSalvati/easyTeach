<?php

namespace Controllers;

use \Template;

use function Models\dumpthisvalue;

class EarningsController
{

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

    public function filterOptions($f3, $params)
    {

        if (!empty($_POST)) {

            $studentSourcesId = $_POST['studentSourceId'];
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];



            $data = new \Models\EarningsModel();

            $totalEarnings = $data->earningsFiltered($studentSourcesId, $startDate, $endDate);

            $this->selectBox($f3);



            $f3->set('sum', $totalEarnings[0]['total']);
            $f3->set('selected_source', $studentSourcesId);
            $f3->set('startDate', $startDate);
            $f3->set('endDate', $endDate);

            


            $f3->set('pageTitle', 'Earnings');
            $f3->set('mainHeading', 'Earnings');
            $f3->set('content', 'Views/content/earnings/displayEarnings.html');

            echo Template::instance()->render('/Views/index.html');
        }
    }


    protected function selectBox($f3)
    {
        $selectBox = new \Models\MultipleChoiceModel();

        $studentSources = $selectBox->studentSources();
        $f3->set('student_sources', $studentSources);
    }
}
