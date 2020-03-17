<?php

namespace Controllers;

use \Template;

class CalendarController 
{

    public function calendarEvents($f3, $params)
    {
        $cm = new \Models\CalendarModel();
        $events = $cm->calendarLessons();
        
        $f3->set('events', json_encode($events));
        $f3->set('jScripts', ['/js/calendar.js', '/assets/demo-to-codepen.js', 'https://unpkg.com/@fullcalendar/core@4.4.0/main.min.js', 'https://unpkg.com/@fullcalendar/interaction@4.4.0/main.min.js', 'https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.min.js', 'https://unpkg.com/@fullcalendar/timegrid@4.4.0/main.min.js']);
        $f3->set('csspaths', ['/assets/demo-to-codepen.css', 'https://unpkg.com/@fullcalendar/core@4.4.0/main.min.css', 'https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.min.css', 'https://unpkg.com/@fullcalendar/timegrid@4.4.0/main.min.css' ]);

        $f3->set('pageTitle', 'Calendar');
        $f3->set('mainHeading', 'Calendar');
        $f3->set('content', 'Views/content/calendar/calendar.html');

        echo Template::instance()->render('/Views/index.html');
    }
}
