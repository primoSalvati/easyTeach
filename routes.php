<?php
//i made named routes, not yet sure how to use them properly ( not only on links, but also in (fat-free) code) @homepage:
//doubt with the named routes: in case of two same urls, like addstudent GET and POST, how to deal with named routes? do i need two different? 
$f3->route('GET @homepage: /', 'Controllers\Homepage->index');
/* $f3->route('GET /login', 'Controllers\LoginController->login'); */ 
/* ROUTES for the section: students */
$f3->route('GET @students: /students', 'Controllers\StudentsController->index');
$f3->route('GET @seeAllStudents: /students/seeAllStudents', 'Controllers\StudentsController->showAll');
$f3->route('GET @studentDetails: /students/seeAllStudents/@sid/details', 'Controllers\StudentsController->studentDetails');
$f3->route('GET @addNewStudent: /students/addStudent', 'Controllers\StudentsController->getForm');
$f3->route('POST /students/addStudent', 'Controllers\StudentsController->postForm');
$f3->route('GET /students/seeAllStudents/@sid/delete', 'Controllers\StudentsController->deleteStudent');
$f3->route('GET /students/seeAllStudents/@sid/details/delete', 'Controllers\StudentsController->deleteStudent');
$f3->route('GET /students/seeAllStudents/@sid/edit', 'Controllers\StudentsController->getCompiledForm');
$f3->route('POST /students/seeAllStudents/@sid/edit', 'Controllers\StudentsController->editStudent');
/* ROUTES for the section: lessons */

/* TODO: ripensare la logica delle pagine iniziali nel modo seguente: invece di avere ad es. students, poi 'add new' e 'see all', questi due bottoni li mantieni sempre nell'header della sezione students, e sotto succede quello che deve succedere. Stessa cosa per le altre sezioni! */

$f3->route('GET @lessons: /lessons', 'Controllers\LessonsController->index');
$f3->route('GET @selectStudentForALesson: /lessons/seeAllStudents', 'Controllers\LessonsController->selectStudent');
$f3->route('GET /lessons/seeAllStudents/@sid/lessonForm', 'Controllers\LessonsController->lessonForm');
$f3->route('POST /lessons/seeAllStudents/@sid/lessonForm', 'Controllers\LessonsController->insertLesson');
$f3->route('GET @seeLessons: /lessons/lessonsList', 'Controllers\LessonsController->lessonsList');
$f3->route('GET /lessons/lessonsList/@lid/details', 'Controllers\LessonsController->lessonDetails');
$f3->route('GET /lessons/lessonsList/@lid/edit', 'Controllers\LessonsController->getCompiledForm');
$f3->route('POST /lessons/lessonsList/@lid/edit', 'Controllers\LessonsController->editLesson');


/* TODO: validare nel server se uno studente esiste già! */

/* ROUTES for the section: calendar */

$f3->route('GET @calendar: /calendar', 'Controllers\CalendarController->calendar');

