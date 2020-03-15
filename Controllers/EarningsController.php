<?php

namespace Controllers;

use \Template;

use function Models\dumpthisvalue;

class EarningsController 
{

    public function display($f3, $params) {

        $data = new \Models\EarningsModel();

        $totalEarnings = $data->earningsTotal();

        /* dumpthisvalue($totalEarnings); */

        /* extract the values from the array earning and sum them */
/*         $sum = 0;
        foreach ($totalEarnings as $array) {
            $sum += $array["earning"];
        } */
         
        /* $sum = 100; */

        $this->selectBox($f3);

        /* $f3->set('values', $sum); */
        $f3->set('sum', $totalEarnings[0]['total']);
        $f3->set('pageTitle', 'Earnings');
        $f3->set('mainHeading', 'Earnings');
        $f3->set('content', 'Views/content/earnings/displayEarnings.html');

        echo Template::instance()->render('/Views/index.html');

    }

    public function filterOptions($f3, $params) {

        $studentSourcesId = $_POST['studentSourceId'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];

        $data = new \Models\EarningsModel();

        $totalEarnings = $data->earningsFiltered($studentSourcesId, $startDate, $endDate);

        $this->selectBox($f3);

        $f3->set('sum', $totalEarnings[0]['total']);
        $f3->set('selected_source', $studentSourcesId);

        $f3->set('pageTitle', 'Earnings');
        $f3->set('mainHeading', 'Earnings');
        $f3->set('content', 'Views/content/earnings/displayEarnings.html');

        echo Template::instance()->render('/Views/index.html');



    }


    protected function selectBox($f3)
    {
        $selectBox = new \Models\MultipleChoiceModel();

        $studentSources = $selectBox->studentSources();
        $f3->set('student_sources', $studentSources);

    }


   

}