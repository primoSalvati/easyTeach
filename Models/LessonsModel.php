<?php

namespace Models;

class LessonsModel extends Model
{

    /**
     * insertLesson
     *
     * @param mixed $event_types_id
     * @param mixed $students_id
     * @param mixed $date
     * @param mixed $time
     * @param mixed $earning
     * @param mixed $address
     * @param mixed $notes
     * 
     * @return bool
     */
    public function insertLesson($event_types_id, $students_id, $date, $time, $earning, $address, $notes): bool
    {


        $lessonInserted = $this->db->exec('INSERT INTO `events` (`date`, `time`, `address`, `earning`, `event_types_id`, `students_id`, `notes`) VALUES (?, ?, ?, ?, ?, ?, ?)', [$date, $time, $address, $earning, $event_types_id, $students_id, $notes]);

        return $lessonInserted;

    }

    /**
     * lessons, extract all lessons. Inside the DB table `events`, there is a foreign-key constraint: students_id, connected with the table `students`, in order to get students name and surname, i need the LEFT JOINS here, also, i want the date to be a readable format, using DATE_FORMAT.
     * 
     *
     * @return array
     */
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

            /* to make my lessons appear from the last on top of the page */

            ORDER BY `date` DESC, `time` DESC'
        
        
        );
    }




    /**
     * lessonDetails
     *
     * @param integer $id
     * 
     * @return array
     */
    public function lessonDetails(int $id): array
    {
        $lessonDetails = $this->db->exec(
            'SELECT events.*,
            DATE_FORMAT(events.date,"%d %b %Y") as `format_date`,
            students.name,
            students.surname,
            /* i extract these two values (instruments.id and lesson_length_id) because, on lesson edit, the select boxes do not work properly with the attribute selected */
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

/* I will need this function to insert the feature of select all lesosns of a student */

/*     public function allLessonsForAStudent(int $id)
    {
        $lessonDetails = $this->db->exec(
            'SELECT * FROM events WHERE events.students_id = ?', $id);
       
         

        if (count($lessonDetails) === 0) {
            return [];
        }

        return $lessonDetails[0];
    } */


    /**
     * editLesson
     *
     * @param mixed $students_id
     * @param mixed $date
     * @param mixed $time
     * @param mixed $earning
     * @param mixed $address
     * @param mixed $notes
     * @param integer $id
     * 
     * @return bool
     */
    public function editLesson($students_id, $date, $time, $earning, $address, $notes, int $id): bool
    {

        $lessonUpdated = $this->db->exec('UPDATE `events` SET `students_id` = ?, `date` = ?, `time` = ?, `earning` = ?, `address` = ?, `notes` = ? WHERE `events`.`id` = ?', [$students_id, $date, $time, $earning, $address, $notes, $id]);

        

        return $lessonUpdated;
    }




    /**
     * deleteLesson cancels the lesson, given the id
     *
     * @param integer $id
     * 
     * @return bool
     */
    public function deleteLesson(int $id): bool
    {
        $isDeleted = $this->db->exec('DELETE FROM `events` WHERE `id` = ?', $id);
        return $isDeleted;
    }
    
}
