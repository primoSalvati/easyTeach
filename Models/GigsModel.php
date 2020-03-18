<?php

namespace Models;

class GigsModel extends Model
{

 /**
  * gigs. this function collects all data from events which are not music lessons (id != 1, the only fix event in database), and, throug left joins, takes the type from the foreign_key event_types_id, the date is formatted, to have a confortable view.
  *
  * @return array
  */
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


 /**
  * insertGig
  *
  * @param mixed $date
  * @param mixed $time
  * @param mixed $address
  * @param mixed $earning
  * @param mixed $event_types_id
  * @param mixed $notes
  * 
  * @return bool
  */
 public function insertGig($date, $time, $address, $earning, $event_types_id, $notes): bool
 {
     $gigInserted = $this->db->exec('INSERT INTO `events` (`date`, `time`, `address`, `earning`, `event_types_id`, `notes`) VALUES (?, ?, ?, ?, ?, ?)' , [$date, $time, $address, $earning, $event_types_id, $notes]);

     return $gigInserted;
 }


 /**
  * gigDetails, gives some detailsof an event, similar to gigs() but with the id requested from the user
  *
  * @param integer $id
  * 
  * @return void
  */
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

        /**
         * editGig
         *
         * @param mixed $event_types_id
         * @param mixed $earning
         * @param mixed $date
         * @param mixed $time
         * @param mixed $address
         * @param mixed $notes
         * @param integer $id
         * 
         * @return bool
         */
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