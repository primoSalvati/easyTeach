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


        return $earningsAndDates;
    }
/* 
    public function earningYear()
    {
        $earningYear = $this->db->exec('SELECT SUM(earning) FROM events WHERE date BETWEEN (2020-3-8) AND (2020-3-9)');
    }
 */

 public function insertEarning($date, $time, $address, $earning, $event_types_id, $notes)
 {

    /* the logic here will be: the user can insert another type of earning (concert, workshop, arrangement etc, whose type can be inserted in the settings, for now, until i make the settings page, i will keep the type id fixed, being a concert(2), later i should change it as '?') */
     $earningInserted = $this->db->exec('INSERT INTO `events` (`date`, `time`, `address`, `earning`, `event_types_id`, `notes`) VALUES (?, ?, ?, ?, 2, ?)' , [$date, $time, $address, $earning, $event_types_id, $notes]);

        return $earningInserted;
 }
 
}