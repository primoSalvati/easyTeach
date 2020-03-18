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
     * earningsFiltered, fetches the earnings with additional information to be filtered: source(student source)
     *
     * @param mixed $studentSourcesId
     * @param mixed $startDate
     * @param mixed $endDate
     * 
     * @return array
     */

     /* attenzione, devo filtrare anche per event types id!!! aggiungendo un altro select box? o forse meglio tutto da un unico select box,,,se possibile */

    public function earningsFiltered($studentSourcesId, $startDate, $endDate): array
    {
        $stmt = 'SELECT SUM(`earning`) AS `total`
                                       FROM `events` AS `e`
                                       LEFT JOIN `students` AS `s` ON s.id = e.students_id
                                       /* LEFT JOIN `event_types` AS `t` ON t.id = e.event_types_id */

                                       WHERE (s.student_sources_id = ifnull(?,"") or ? is null)
                                       and (e.date BETWEEN IFNULL(?,"1900-01-01") 
                                           AND IFNULL(?,now()))
                                       /* and (e.event_types_id = ifnull(?,"") or ? is null) */';


        $earnings = $this->db->exec($stmt, [valOrNull($studentSourcesId), valOrNull($studentSourcesId), valOrNull($startDate), valOrNull($endDate)]);
        return $earnings;
    }

/*   original statement  $stmt = 'SELECT SUM(`earning`) AS `total`
                                       FROM `events` AS `e`
                                       LEFT JOIN `students` AS `s` ON s.id = e.students_id
                                       WHERE (s.student_sources_id = ifnull(?,"") or ? is null)
                                       and (e.date BETWEEN IFNULL(?,"1900-01-01") 
                                           AND IFNULL(?,now()))'; */


    
}
