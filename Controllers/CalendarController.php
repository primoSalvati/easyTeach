<?php

namespace Controllers;

use \Template;

class CalendarController
{

    public function calendar($f3, $params)
    {
        $cm = new \Models\CalendarModel();
        $events = $cm->calendarEvents();
        
        $f3->set('events', json_encode($events));
        $f3->set('pageTitle', 'Calendar');
        $f3->set('mainHeading', 'Calendar');
        $f3->set('content', 'Views/content/calendar/calendar.html');

        echo Template::instance()->render('/Views/index.html');
    }
}
