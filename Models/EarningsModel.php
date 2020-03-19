<?php

namespace Models;

class EarningsModel extends Model
{


    /**
     * earningsTotal, fetches all the earnings from the table events, and sums them
     *
     * @return array
     */
    public function earningsTotal(): array
    {
        $earnings = $this->db->exec('SELECT SUM(`earning`) AS `total` FROM `events`');

        return $earnings;
    }


    /**
     * earningsFiltered, fetches the earnings with additional information to be filtered: source(student source), event_type(for concerts, compositions etc) and star/end date
     *
     * @param mixed $studentSourcesId
     * @param mixed $startDate
     * @param mixed $endDate
     * 
     * @return array
     */



    public function earningsFiltered($studentSourcesId, $startDate, $endDate, $eventTypeId): array
    {
        $stmt = 'SELECT SUM(`earning`) AS `total`
                                       FROM `events` AS `e`
                                       LEFT JOIN `students` AS `s` ON s.id = e.students_id
                                       LEFT JOIN `event_types` AS `t` ON t.id = e.event_types_id 

                                       WHERE 
                                       (e.date BETWEEN IFNULL(?,"1900-01-01") 
                                           AND IFNULL(?,now()))
                                       and    
                                       ((? != "" and (s.student_sources_id = ifnull(?,"") or ? is null))
                                       or
                                       (? != "" and (e.event_types_id = ifnull(?,"") or ? is null)))';


        $earnings = $this->db->exec($stmt, [
            valOrNull($startDate), valOrNull($endDate),
             valOrNull($studentSourcesId), valOrNull($studentSourcesId),
             valOrNull($eventTypeId), valOrNull($eventTypeId)
        ]);

        file_put_contents('/users/primosalvati/debug.log',$this->db->log() , FILE_APPEND);
        return $earnings;
    }

/*   original statement  $stmt = 'SELECT SUM(`earning`) AS `total`
                                       FROM `events` AS `e`
                                       LEFT JOIN `students` AS `s` ON s.id = e.students_id
                                       WHERE (s.student_sources_id = ifnull(?,"") or ? is null)
                                       and (e.date BETWEEN IFNULL(?,"1900-01-01") 
                                           AND IFNULL(?,now()))'; */


    
}
