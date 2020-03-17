<?php

$f3->route('GET @homepage: /', 'Controllers\Homepage->index');
/* ROUTES for the section: students */
$f3->route('GET /login', 'Controllers\UserController->renderLogin'); 
$f3->route('POST /authenticate', 'Controllers\UserController->authenticate'); 
/* ROUTES for the section: students */

$f3->route('GET @students: /students', 'Controllers\StudentsController->index');
$f3->route('GET @studentDetails: /students/@sid/details', 'Controllers\StudentsController->studentDetails');
$f3->route('GET @addNewStudent: /students/addStudent', 'Controllers\StudentsController->getForm');
$f3->route('POST /students/addStudent', 'Controllers\StudentsController->postForm');
$f3->route('GET /students/@sid/delete', 'Controllers\StudentsController->deleteStudent');

$f3->route('GET /students/@sid/edit', 'Controllers\StudentsController->getCompiledForm');
$f3->route('POST /students/@sid/edit', 'Controllers\StudentsController->editStudent');
/* ROUTES for the section: lessons */


/* TODO: mettere a tutte le routes un nome, anche se poi non lo usi */

/* $f3->route('GET  /lessons', 'Controllers\LessonsController->index'); */
$f3->route('GET @lessons: /lessons', 'Controllers\LessonsController->index');
$f3->route('GET @selectStudentForALesson: /lessons/seeAllStudents', 'Controllers\LessonsController->selectStudent');
$f3->route('GET /lessons/seeAllStudents/@sid/lessonForm', 'Controllers\LessonsController->lessonForm');
$f3->route('POST /lessons/seeAllStudents/@sid/lessonForm', 'Controllers\LessonsController->insertLesson');
$f3->route('GET /lessons/@lid/details', 'Controllers\LessonsController->lessonDetails');
$f3->route('GET /lessons/@lid/edit', 'Controllers\LessonsController->getCompiledForm');
$f3->route('POST /lessons/@lid/edit', 'Controllers\LessonsController->editLesson');
$f3->route('GET /lessons/@lid/delete', 'Controllers\LessonsController->deleteLesson');

/* TODO: validare nel server se uno studente esiste già! */

/* ROUTES for the section: calendar */

$f3->route('GET @calendar: /calendar', 'Controllers\CalendarController->calendarLessons');

/* ROUTES for the section: earnings */

$f3->route('GET @displayEarnings: /earnings', 'Controllers\EarningsController->display');
$f3->route('POST /earnings', 'Controllers\EarningsController->filterOptions');

/* $f3->route('GET  /earnings/filter', 'Controllers\EarningsController->filterOptions'); */



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
$f3->route('POST @settingsPost: /settings', 'Controllers\SettingsController->insertInstrument');
$f3->route('GET @settingsDeleteInst: /settingsInst/@instid/delete', 'Controllers\SettingsController->deleteInstrument');






