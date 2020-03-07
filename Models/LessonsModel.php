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
    {/* problem: if i customize the date like below, the browser, on edit, doesn't receive the rigth value */
        $lessonDetails = $this->db->exec(
            'SELECT events.*,
            DATE_FORMAT(events.date,"%d %b %Y") as `format_date`,
            students.name,
            students.surname,
            /* i extract these two values (instruments.id and lesson_length_id because , on lesson edit, the select boxes were not properly working with the attribute selected) */
            instruments.id AS instruments_id,
            instruments.type AS instrument,
            lesson_length.id AS lesson_length_id,
            lesson_length.length AS lesson_length
            
            FROM `events` 

            LEFT JOIN `students` ON events.students_id = students.id
            LEFT JOIN `instruments` ON students.instruments_id = instruments.id
            LEFT JOIN `lesson_length` ON students.lesson_length_id = lesson_length.id


            WHERE events.id = ?', $id);
       
       

        if (count($lessonDetails) === 0) {
            return [];
        }

        return $lessonDetails[0];
    }

/* Achtung, questa funzione mi serve dopo, se voglio vedere tutte le lezioni precedenti di uno studente*/
    public function allLessonsForAStudent(int $id)
    {
        $lessonDetails = $this->db->exec(
            'SELECT * FROM events WHERE events.students_id = ?', $id);
       
         

        if (count($lessonDetails) === 0) {
            return [];
        }

        return $lessonDetails[0];
    }


/* ACHTUNG, i can't edit the instrument until i make the lookup table instruments_students, see what about lesson length (it will have to do with calendar, later) */
    public function editLesson($students_id, $date, $time, $earning, $address, $notes, int $id): bool
    {
/* un problema potrebbe essere la Reihenfolge! */
        $lessonUpdated = $this->db->exec('UPDATE `events` SET `students_id` = ?, `date` = ?, `time` = ?, `earning` = ?, `address` = ?, `notes` = ? WHERE `events`.`id` = ?', [$students_id, $date, $time, $earning, $address, $notes, $id]);

        return $lessonUpdated;
    }


    /**
     * deleteLesson, cancels lesson, given the id
     *
     * @param integer $id
     * 
     * @return void
     */
    public function deleteLesson(int $id)
    {
        $isDeleted = $this->db->exec('DELETE FROM `events` WHERE `id` = ?', $id);
        return $isDeleted;
    }
    
}
