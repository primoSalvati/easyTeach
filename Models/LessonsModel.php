<?php

namespace Models;

class LessonsModel extends Model
{

    public function insertLesson($event_types_id, $students_id, $date, $time, $earning, $address, $notes): bool
    {

/* TODO:devo poter inserire più file, inoltre devo poter dare la possibilità di inserire i diversi tipi di file */


        $lessonInserted = $this->db->exec('INSERT INTO `events` (`date`, `time`, `address`, `earning`, `event_types_id`, `students_id`, `notes`) VALUES (?, ?, ?, ?, ?, ?, ?)', [$date, $time, $address, $earning, $event_types_id, $students_id, $notes]);

        return $lessonInserted;

    }

    public function lessons(): array
    {
        return $this->db->exec(
            'SELECT events.*,

            /* customize the date */
            DATE_FORMAT(events.date,"%d %b %Y") as `date`,
            students.name,
            students.surname
            
            FROM `events` 

            LEFT JOIN `students` ON events.students_id = students.id
            
            WHERE `event_types_id` = 1

            ORDER BY `date`, `time`'
        
        
        );
    }


    public function lessonDetails(int $id)
    {/* problem: if i customize the date like below, the browser, on edit, diesn't receive the rigth value */
        $lessonDetails = $this->db->exec(
            'SELECT events.*,
            /* DATE_FORMAT(events.date,"%d %b %Y") as `date`, */
            students.name,
            students.surname,
            instruments.type AS instrument,
            lesson_length.length AS lesson_length
            
            FROM `events` 

            LEFT JOIN `students` ON events.students_id = students.id
            LEFT JOIN `instruments` ON students.instruments_id = instruments.id
            LEFT JOIN `lesson_length` ON students.lesson_length_id = lesson_length.id


            WHERE events.id = ?', $id);
       
            /* debug_to_console($id); */

        if (count($lessonDetails) === 0) {
            return [];
        }

        return $lessonDetails[0];
    }

/* Achtung, questa funzione mi serve dopo, se voglio vedere tutte le lezioni precedenti di uno studente*/
    public function allLessonsForStudent(int $id)
    {
        $lessonDetails = $this->db->exec(
            'SELECT * FROM events WHERE events.students_id = ?', $id);
       
            debug_to_console($id);

        if (count($lessonDetails) === 0) {
            return [];
        }

        return $lessonDetails[0];
    }
    
}
