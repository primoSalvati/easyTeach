<?php

namespace Models;

class CalendarModel extends Model
{


    /**
     * calendarLessons, taken from the fullCalendar documentation, i need to give the initial date and final date of an event(same day...) and, if the event is a lesson, i will have name and surname shown as an event title, otherwise i will have the event_type.type (concert, arrangement etc)
     *
     * @return array
     */
    public function calendarLessons(): array
    { $events=$this->db->exec(
            'select date as start, date as end, coalesce(concat(students.name," ",students.surname),event_types.type) as title
            from events
             left join students on students.id=events.students_id
             left join event_types on event_types.id=events.event_types_id');

        return $events;
    }


 }
