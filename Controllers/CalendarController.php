<?php

namespace Controllers;

use \Template;

class CalendarController 
{

    public function calendarLessons($f3, $params)
    {
        $cm = new \Models\CalendarModel();
        $events = $cm->calendarLessons();
        
        $f3->set('events', json_encode($events));
        $f3->set('jScripts', ['/js/calendar.js']);
        $f3->set('pageTitle', 'Calendar');
        $f3->set('mainHeading', 'Calendar');
        $f3->set('content', 'Views/content/calendar/calendar.html');

        echo Template::instance()->render('/Views/index.html');
    }
}
