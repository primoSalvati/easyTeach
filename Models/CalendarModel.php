<?php

namespace Models;

class CalendarModel extends Model
{


    public function calendarLessons(): array
    { $events=$this->db->exec(
            'select date as start, date as end, coalesce(concat(students.name," ",students.surname),event_types.type) as title
            from events
             left join students on students.id=events.students_id
             left join event_types on event_types.id=events.event_types_id');

        return $events;
    }


 }
