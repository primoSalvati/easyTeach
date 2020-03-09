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

    public function insertEarning($f3, $params) {


        if (!empty($_POST)) {
            $gump = new \GUMP('en');


/*             $gump->validation_rules(array(
                'date' => 'required|date',
                'time' => 'required',
                'earning' => 'required|numeric',
                'address' => 'max_len, 50',
                'notes' => 'max_len, 2500',
                'links' => 'valid_url',
            )); */

/*             $gump->filter_rules(array(
                'earning' => 'trim|sanitize_string',
                'address' => 'trim|sanitize_string',
                'notes' => 'sanitize_string',
                'files' => 'sanitize_string',
                'links' => 'trim|sanitize_string',
            )); */

            $validData = $gump->run($_POST);



            if ($validData === false) {
                $errors = $gump->get_errors_array();
                $f3->set('errors', $errors);

                $f3->set('values', $_POST);


                date_default_timezone_set('Europe/Vienna');

                $f3->set('currentDate', date('Y-m-d'));
                $f3->set('currentTime', date('H:i'));

                $f3->set('pageTitle', 'Insert Earning');
                $f3->set('mainHeading', 'Insert Earning');
                $f3->set('content', '/Views/content/earnings/earningForm.html');

                echo Template::instance()->render('/Views/index.html');
            } else {
                $em = new \Models\EarningsModel();
                $earningInserted = $em->insertEarning($validData['date'], $validData['time'], $validData['address'], $validData['earning'], $validData['event_types_id'], $validData['notes']);


                if ($earningInserted === true) {
                    $f3->set('alertSuccess', 'New earning successfully inserted!');
                } else {
                    $f3->set('alertError', 'Error! The earning couldn\'t be inserted.');

                            /* to display the success with a javascript alert, todo also for students detail and lesson details */
        /* $f3->set('jScripts', ['/js/earningAlert.js']); */
                }





        $f3->set('pageTitle', 'Earnings');
        $f3->set('mainHeading', 'Earnings');
        $f3->set('content', 'Views/content/earnings/displayEarnings.html');

        echo Template::instance()->render('/Views/index.html');

    }

}