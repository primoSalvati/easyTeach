<?php

namespace Models;

class GigModel extends Model
{

 public function insertGig($date, $time, $address, $earning, $event_types_id, $notes): bool
 {
     $gigInserted = $this->db->exec('INSERT INTO `events` (`date`, `time`, `address`, `earning`, `event_types_id`, `notes`) VALUES (?, ?, ?, ?, ?, ?)' , [$date, $time, $address, $earning, $event_types_id, $notes]);

     return $gigInserted;
 }

}