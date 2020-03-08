<?php

namespace Models;

class EarningsModel extends Model
{

    public function earningsTotal() : array
    {
        $earnings = $this->db->exec('SELECT `earning` FROM `events`');

        return $earnings;
    }

    public function earningsAndDates(): array
    {
        $earningsAndDates = $this->db->exec('SELECT `earning`, `date` FROM `events` ORDER BY `date` DESC');

        /*         if (count($earnings) === 0) {
            return [];
        } */

        return $earningsAndDates;
    }

}