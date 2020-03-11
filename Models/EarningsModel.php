<?php

namespace Models;

class EarningsModel extends Model
{

    /*     public function earningsTotal() : array
    {
        $earnings = $this->db->exec('SELECT `earning` FROM `events`');

        return $earnings;
    } */

    public function earningsTotal(): array
    {
        $earnings = $this->db->exec('SELECT SUM(`earning`) AS `total` FROM `events`');

        return $earnings;
    }

    /*     public function earningsFiltered($studentSourcesId): array
    {
        $earnings = $this->db->exec('SELECT SUM(`earning`) AS `total`
                                     FROM `events` `e`
                                     INNER JOIN `students` AS `s` ON s.id = e.students_id
                                     WHERE s.student_sources_id = ?', valOrNull($studentSourcesId));

        return $earnings;
    }*/


    public function earningsFiltered($studentSourcesId): array
    {
        $stmt = 'SELECT SUM(`earning`) AS `total`
                                       FROM `events` AS `e`
                                       LEFT JOIN `students` AS `s` ON s.id = e.students_id';
        if (is_null(valOrNull($studentSourcesId))) {
            $earnings = $this->db->exec($stmt);
            return $earnings;
        }

        $stmt .= ' WHERE s.student_sources_id = ?';
        $earnings = $this->db->exec($stmt, valOrNull($studentSourcesId));
        return $earnings;


    }
    


        /* PER LA DATA
        
            public function earningsFiltered($studentSourcesId): array
    {
        $earnings = $this->db->exec('SELECT SUM(`earning`) AS `total`
                                     FROM `events` `e`
                                     INNER JOIN `students` AS `s` ON s.id = e.students_id
                                     WHERE s.student_sources_id = ?', valOrNull($studentSourcesId));

        return $earnings;
    }


Jernej, 20:39
public function earningsFiltered($studentSourcesId): array
{
    $stmt ='SELECT SUM(`earning`) AS `total`
                                    FROM `events` `e`
                                    INNER JOIN `students` AS `s` ON s.id = e.students_id';
    if(valOrNull($studentSourcesId)===null){
        $earnings = $this->db->exec( $stmt);
        return $earnings;
    }

    $stmt=$stmt+'WHERE s.student_sources_id = ?';
    $earnings = $this->db->exec( $stmt, valOrNull($studentSourcesId));
    return $earnings;                              
                                

    
}

SOLO QUESTO
Jernej, 20:52
public function earningsFiltered($studentSourcesId, $fromDate, $toDate): array
{
    $stmt ='SELECT SUM(`earning`) AS `total`
                                    FROM `events` `e`
                                    INNER JOIN `students` AS `s` ON s.id = e.students_id';
    if(is_null(valOrNull($studentSourcesId)) && (is_null(valOrNull($fromDate)) && (is_null(valOrNull($toDate))) ){
        $earnings = $this->db->exec( $stmt);
        return $earnings;
    }

    $stmt.=' WHERE';
    if(!is_null(valOrNull($studentSourcesId)){
        $stmt.=' s.student_sources_id = ?';
    }
    if(!is_null(valOrNull($fromDate)){
        $stmt.=' s.date >= ?';
    }
    if(!is_null(valOrNull($toDate)){
        $stmt.=' s.date >= ?';
    }
    
    $earnings = $this->db->exec( $stmt, valOrNull($studentSourcesId),valOrNull($fromDate),valOrNull($toDate));
    return $earnings;                              
                                

    
}*/




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
        $earningInserted = $this->db->exec('INSERT INTO `events` (`date`, `time`, `address`, `earning`, `event_types_id`, `notes`) VALUES (?, ?, ?, ?, ?, ?)', [$date, $time, $address, $earning, $event_types_id, $notes]);

        return $earningInserted;
    }
}
