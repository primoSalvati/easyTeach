<?php

namespace Models;

class CalendarModel extends Model
{


    public function calendarLessons(): array
    { $events=$this->db->exec(
            'select date as start, date as end, concat(students.name," ",students.surname) as title
            from events
             left join students on students.id=events.students_id');

        return $events;
    }

        public function calendarGigs(): array
    { $events=$this->db->exec(
            'select date as start, date as end, !empty(students)? concat(students.name," ",students.surname) : event_types.type as title
            from events
             left join students on students.id=events.students_id');

        return $events;
    }

 }
