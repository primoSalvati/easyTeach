<?php

namespace Models;

class GigsModel extends Model
{

 public function gigs(): array
    
 {
    return $this->db->exec('SELECT events.*,

            /* customize the date */
            DATE_FORMAT(events.date,"%d %b %Y") as `date`,
            event_types.type as event_type
            
            FROM `events` 

            LEFT JOIN `event_types` ON events.event_types_id = event_types.id
            
            WHERE `event_types_id` != 1

            /* to make my gigs appear from the last on top of the page */

            ORDER BY `date` DESC, `time` DESC');


    
 }


 public function insertGig($date, $time, $address, $earning, $event_types_id, $notes): bool
 {
     $gigInserted = $this->db->exec('INSERT INTO `events` (`date`, `time`, `address`, `earning`, `event_types_id`, `notes`) VALUES (?, ?, ?, ?, ?, ?)' , [$date, $time, $address, $earning, $event_types_id, $notes]);

     return $gigInserted;
 }


 public function gigDetails(int $id)
    {   
        $gigDetails = $this->db->exec(
            'SELECT events.*, 
            /* date format customized */
            DATE_FORMAT(events.date,"%d %b %Y") as `format_date`,
            event_types.type AS event_type
             
            FROM `events` 

            LEFT JOIN `event_types` ON events.event_types_id = event_types.id
            
            WHERE events.id = ?', $id
            
        );

        
        if (count($gigDetails) === 0) {
            return [];
        }

        return $gigDetails[0];
    }

        public function editGig($event_types_id, $earning, $date, $time, $address, $notes, int $id): bool
    {

        $gigUpdated = $this->db->exec('UPDATE `events` SET `event_types_id` = ?, `earning` = ?, `date` = ?, `time` = ?, `address` = ?, `notes` = ? WHERE `events`.`id` = ?', [$event_types_id, $earning, $date, $time, $address, $notes, $id]);

        return $gigUpdated;
    }
        /**
     * deleteGig, cancels gig, given the id
     *
     * @param integer $id
     * 
     * @return void
     */
    public function deleteGig(int $id)
    {
        $isDeleted = $this->db->exec('DELETE FROM `events` WHERE `id` = ?', $id);
        return $isDeleted;
    }

}