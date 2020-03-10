<?php
//i made named routes, not yet sure how to use them properly ( not only on links, but also in (fat-free) code) @homepage:
//doubt with the named routes: in case of two same urls, like addstudent GET and POST, how to deal with named routes? do i need two different? 
$f3->route('GET @homepage: /', 'Controllers\Homepage->index');
/* $f3->route('GET /login', 'Controllers\LoginController->login'); */ 
/* ROUTES for the section: students */
/* 
achtung, route deleted, i keep it here in case of bugs, check also the functions to be deleted!
$f3->route('GET  /students', 'Controllers\StudentsController->index'); */
$f3->route('GET @students: /students', 'Controllers\StudentsController->index');
$f3->route('GET @studentDetails: /students/@sid/details', 'Controllers\StudentsController->studentDetails');
$f3->route('GET @addNewStudent: /students/addStudent', 'Controllers\StudentsController->getForm');
$f3->route('POST /students/addStudent', 'Controllers\StudentsController->postForm');
$f3->route('GET /students/@sid/delete', 'Controllers\StudentsController->deleteStudent');
/* ACHTUNG! do i need a second route to delete a student from the page details? maybe only because of the JavaScript commands... */
$f3->route('GET /students/@sid/edit', 'Controllers\StudentsController->getCompiledForm');
$f3->route('POST /students/@sid/edit', 'Controllers\StudentsController->editStudent');
/* ROUTES for the section: lessons */

/* TODO: ripensare la logica delle pagine iniziali nel modo seguente: invece di avere ad es. students, poi 'add new' e 'see all', questi due bottoni li mantieni sempre nell'header della sezione students, e sotto succede quello che deve succedere. Stessa cosa per le altre sezioni! */

/* $f3->route('GET  /lessons', 'Controllers\LessonsController->index'); */
$f3->route('GET @lessons: /lessons', 'Controllers\LessonsController->index');
$f3->route('GET @selectStudentForALesson: /lessons/seeAllStudents', 'Controllers\LessonsController->selectStudent');
$f3->route('GET /lessons/seeAllStudents/@sid/lessonForm', 'Controllers\LessonsController->lessonForm');
$f3->route('POST /lessons/seeAllStudents/@sid/lessonForm', 'Controllers\LessonsController->insertLesson');
$f3->route('GET /lessons/@lid/details', 'Controllers\LessonsController->lessonDetails');
$f3->route('GET /lessons/@lid/edit', 'Controllers\LessonsController->getCompiledForm');
$f3->route('POST /lessons/@lid/edit', 'Controllers\LessonsController->editLesson');
$f3->route('GET /lessons/@lid/delete', 'Controllers\LessonsController->deleteLesson');

/* TODO: weil ich das gleiche .js File für delete Lesson und Student verwende, (wenn es ok ist), sollte ich das File umbenennen--nicht mehr student.js sondern delete.js */
/* TODO: validare nel server se uno studente esiste già! */

/* ROUTES for the section: calendar */

$f3->route('GET @calendar: /calendar', 'Controllers\CalendarController->calendarLessons');

/* ROUTES for the section: earnings */

$f3->route('GET @displayEarnings: /earnings', 'Controllers\EarningsController->display');
/* probably i won't need this route, i will only make a select box with the possible filters */
$f3->route('GET @filterEarnings: /earnings/filter', 'Controllers\EarningsController->filterOptions');



/* ROUTES for the section: new gig */

$f3->route('GET @insertGig: /newGig/insert', 'Controllers\GigController->gigForm');
$f3->route('POST @insertGig: /newGig/insert', 'Controllers\GigController->insertGig');

