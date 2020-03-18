<?php

$f3->route('GET @homepage: /', 'Controllers\Homepage->index');

/* ROUTES for the section: login */
/* $f3->route('GET @login: /login', 'Controllers\UserController->renderLogin'); 
$f3->route('POST @authenticate: /authenticate', 'Controllers\UserController->authenticate');  */

/* ROUTES for the section: students */

$f3->route('GET @students: /students', 'Controllers\StudentsController->index');
$f3->route('GET @studentDetails: /students/@sid/details', 'Controllers\StudentsController->studentDetails');
$f3->route('GET @addNewStudent: /students/addStudent', 'Controllers\StudentsController->getForm');
$f3->route('POST @addNewStudentPost: /students/addStudent', 'Controllers\StudentsController->postForm');
$f3->route('GET @deleteStudent: /students/@sid/delete', 'Controllers\StudentsController->deleteStudent');

$f3->route('GET @editStudent: /students/@sid/edit', 'Controllers\StudentsController->getCompiledForm');
$f3->route('POST @editStudentPost: /students/@sid/edit', 'Controllers\StudentsController->editStudent');

/* ROUTES for the section: lessons */

$f3->route('GET @lessons: /lessons', 'Controllers\LessonsController->index');
$f3->route('GET @selectStudentForALesson: /lessons/seeAllStudents', 'Controllers\LessonsController->selectStudent');
$f3->route('GET @lessonForm: /lessons/seeAllStudents/@sid/lessonForm', 'Controllers\LessonsController->lessonForm');
$f3->route('POST @insertLesson: /lessons/seeAllStudents/@sid/lessonForm', 'Controllers\LessonsController->insertLesson');
$f3->route('GET @lessonDetails: /lessons/@lid/details', 'Controllers\LessonsController->lessonDetails');
$f3->route('GET @lessonForm: /lessons/@lid/edit', 'Controllers\LessonsController->getCompiledForm');
$f3->route('POST @editLesson: /lessons/@lid/edit', 'Controllers\LessonsController->editLesson');
$f3->route('GET @deleteLesson: /lessons/@lid/delete', 'Controllers\LessonsController->deleteLesson');

/* TODO: validare nel server se uno studente esiste già! */

/* ROUTES for the section: calendar */

$f3->route('GET @calendar: /calendar', 'Controllers\CalendarController->calendarEvents');

/* ROUTES for the section: earnings */

$f3->route('GET @displayEarnings: /earnings', 'Controllers\EarningsController->display');
$f3->route('POST @filterEarnings: /earnings', 'Controllers\EarningsController->filterOptions');


/* ROUTES for the section: gig */

$f3->route('GET @gigs: /gigs', 'Controllers\GigsController->index');
$f3->route('GET @insertGig: /gigs/insert', 'Controllers\GigsController->gigForm');
$f3->route('POST @insertGig: /gigs/insert', 'Controllers\GigsController->insertGig');
$f3->route('GET @gigDetails: /gigs/@gid/details', 'Controllers\GigsController->gigDetails');
$f3->route('GET  @editGig:  /gigs/@gid/edit', 'Controllers\GigsController->getCompiledForm');
$f3->route('POST @editGig:  /gigs/@gid/edit', 'Controllers\GigsController->editGig');
$f3->route('GET @deleteGig: /gigs/@gid/delete', 'Controllers\GigsController->deleteGig');


/* ROUTES for the section: settings */

$f3->route('GET @settings: /settings', 'Controllers\SettingsController->index');

$f3->route('POST @settings: /settings', 'Controllers\SettingsController->insertInstruments');
/* the routes delete, as soon as they where many, started to make confusion, and i named them all differently, it works like that */
$f3->route('GET @settings:  /settings/deleteInst/@instrId', 'Controllers\SettingsController->deleteInstruments');
/* teh GET route is meant to refresh page after inserting a value, and go back to the index function */
$f3->route('GET @settings:  /settings/eventTypes', 'Controllers\SettingsController->index');
$f3->route('POST @setInsertInst: /settings/eventTypes', 'Controllers\SettingsController->insertEventTypes');
$f3->route('GET @setDelInst:  /settings/deleteEvType/@evTypeId', 'Controllers\SettingsController->deleteEventTypes');

$f3->route('GET @refreshInsertSource:  /settings/studentSources', 'Controllers\SettingsController->index');
$f3->route('POST @setInsertSource:  /settings/studentSources', 'Controllers\SettingsController->insertStudentSources');
$f3->route('GET @setDelSource:  /settings/deleteSource/@stSourceId', 'Controllers\SettingsController->deleteStudentSources');

$f3->route('GET @refreshInsertLength:  /settings/lessonLength', 'Controllers\SettingsController->index');
$f3->route('POST @setInsertLength:  /settings/lessonLength', 'Controllers\SettingsController->insertLessonLengths');
$f3->route('GET @setDelLength:  /settings/deleteLessLength/@lesLenghId', 'Controllers\SettingsController->deleteLessonLengths');

$f3->route('GET @refreshInsertRegul:  /settings/studentRegularity', 'Controllers\SettingsController->index');
$f3->route('POST @setInsertRegul:  /settings/studentRegularity', 'Controllers\SettingsController->insertStudentRegularities');
$f3->route('GET @setDelRegul:  /settings/deleteRegul/@stRegId', 'Controllers\SettingsController->deleteStudentRegularities');

 








