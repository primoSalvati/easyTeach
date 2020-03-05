<?php

namespace Models;

class CalendarModel extends Model
{

    /**
     * selects all data from the table students
     *
     * @return array
     */
    public function calendarEvents(): array
    { $events=$this->db->exec(
            'select date as start, date as end, concat(students.name," ",students.surname) as title
            from events
             left join students on students.id=events.students_id');

        return $events;
    }

 }
