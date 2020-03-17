<?php

namespace Models;

class StudentsModel extends Model
{

    /**
     * selects all data from the table students
     *
     * @return array
     */
    public function students(): array
    {
        return $this->db->exec('SELECT * FROM `students`');
    }

    /**
     * studentDetails: given the id number, returns all data of a student in an array. For the foreign keys inside the table students, like instruments_id or student_sources_id, there are LEFT JOIN in order to obtain their corresponding values. Furthermore, since different tables can have same column name, on the first line after the SELECT statement there is a name specification for every result which will be obtained from LEFT JOINS
     *
     * @param integer $id
     * 
     * @return void
     */
    public function studentDetails(int $id) 
    {  
        $studentDetails = $this->db->exec(
            'SELECT students.*, 
            /* date format customized */
            DATE_FORMAT(students.date_of_birth,"%d %b %Y") as `format_date_of_birth`,
            student_sources.source AS source,
            instruments.type AS instrument,
            lesson_length.length AS length,
            student_regularity.type AS regularity
             
            FROM `students` 
            LEFT JOIN student_sources ON students.student_sources_id = student_sources.id 
            LEFT JOIN instruments ON students.instruments_id = instruments.id 
            LEFT JOIN lesson_length ON students.lesson_length_id = lesson_length.id
            LEFT JOIN student_regularity ON students.student_regularity_id = student_regularity.id
            
            WHERE students.id = ?',
            $id
        );
        
        if (count($studentDetails) === 0) {
            return [];
        }

        return $studentDetails[0];
    }

    /**
     * addStudent, inserts all data from a student form in database. The if statement for $date_of_birth is necessary because, even if the database accepts NULL values, it is sent as an empty string, so there is a conversion to NULL.
     *
     * @param mixed $name
     * @param mixed $surname
     * @param mixed $email
     * @param mixed $telephone
     * @param mixed $date_of_birth
     * @param mixed $student_price
     * @param mixed $student_source
     * @param mixed $instrument
     * @param mixed $lesson_length
     * @param mixed $student_regularity
     * 
     * @return bool
     */
    public function addStudent($name, $surname, $email, $telephone, $date_of_birth, $student_price, $student_source, $instrument, $lesson_length, $student_regularity): bool
    {
        if ($date_of_birth === '') {
            $date_of_birth = null;
        } 

        $studentInserted = $this->db->exec('INSERT INTO `students` (name, surname, email, phone, date_of_birth, student_price, student_sources_id, instruments_id, lesson_length_id, student_regularity_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$name, $surname, $email, $telephone, $date_of_birth, $student_price, valOrNull($student_source), valOrNull($instrument), valOrNull($lesson_length), valOrNull($student_regularity)]);

        return $studentInserted;
    }

    /**
     * deleteStudent, cancels students, given the id
     *
     * @param integer $id
     * 
     * @return void
     */
    public function deleteStudent(int $id)
    {
        $isDeleted = $this->db->exec('DELETE FROM `students` WHERE `id` = ?', $id);
        return $isDeleted;
    }



    /**
     * similar structure as addStudent, but with the sql statement UPDATE, and with an id to be received
     *
     * @param mixed $name
     * @param mixed $surname
     * @param mixed $email
     * @param mixed $telephone
     * @param mixed $date_of_birth
     * @param mixed $student_price
     * @param mixed $student_source
     * @param mixed $instrument
     * @param mixed $lesson_length
     * @param mixed $student_regularity
     * @param integer $id
     * 
     * @return bool
     */
    public function editStudent($name, $surname, $email, $telephone, $date_of_birth, $student_price, $student_source, $instrument, $lesson_length, $student_regularity, int $id): bool
    {
        if ($date_of_birth === '') {
            $date_of_birth = null;
        } 
        
        $isStored = $this->db->exec('UPDATE `students` SET `name` = ?, `surname` = ?, `email` = ?, `phone` = ?, `date_of_birth` = ?, `student_price` = ?, `student_sources_id` = ?, `instruments_id` = ?, `lesson_length_id` = ?, `student_regularity_id` = ? WHERE `students`.`id` = ?', [$name, $surname, $email, $telephone, $date_of_birth, $student_price, valOrNull($student_source), valOrNull($instrument), valOrNull($lesson_length), valOrNull($student_regularity), $id]);

        return $isStored;
    }


 }
