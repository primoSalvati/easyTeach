<?php

namespace Models;

class EarningsModel extends Model
{


    public function earningsTotal(): array
    {
        $earnings = $this->db->exec('SELECT SUM(`earning`) AS `total` FROM `events`');

        return $earnings;
    }


    public function earningsFiltered($studentSourcesId, $startDate, $endDate): array
    {
        $stmt = 'SELECT SUM(`earning`) AS `total`
                                       FROM `events` AS `e`
                                       LEFT JOIN `students` AS `s` ON s.id = e.students_id
                                       WHERE (s.student_sources_id = ifnull(?,"") or ? is null)
                                       and (e.date BETWEEN IFNULL(?,"1900-01-01") 
                                           AND IFNULL(?,now()))';


        $earnings = $this->db->exec($stmt, [valOrNull($studentSourcesId), valOrNull($studentSourcesId), valOrNull($startDate), valOrNull($endDate)]);
        return $earnings;
    }


    
}
