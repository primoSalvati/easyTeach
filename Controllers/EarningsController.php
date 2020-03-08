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

        /* extract the values from the array earning and sum them*/
        $sum = 0;
        foreach ($totalEarnings as $array) {
            $sum += $array["earning"];
        }

       

        $f3->set('sum', $sum);
        $f3->set('pageTitle', 'Earnings');
        $f3->set('mainHeading', 'Earnings');
        $f3->set('content', 'Views/content/earnings/displayEarnings.html');

        echo Template::instance()->render('/Views/index.html');

    }


}