<?php

namespace Models;

class MultipleChoiceModel extends Model
{

    /* is it necessary to specify : array ? */

    public function studentSources()
    {
        $studentSources = $this->db->exec('SELECT * FROM `student_sources` ORDER BY `source`');

        return $studentSources;
    }

    public function allInstruments()/* : array */
    {
        $instruments = $this->db->exec('SELECT * FROM `instruments` ORDER BY `type`');

        return $instruments;
    }

    public function lessonLength()
    {
        $lessonLength = $this->db->exec('SELECT * FROM `lesson_length`');
        return $lessonLength;
    }


    public function studentRegularity()
    {
        $studentRegularity = $this->db->exec('SELECT * FROM `student_regularity`');

        return $studentRegularity;
    }
    /* this function is meant to put the students on a select box when inserting/updating a lesson, as a usability feature */
    public function studentList() {

        $studentList = $this->db->exec('SELECT `id`, `name`, `surname` FROM `students`');

        return $studentList;
    }

    public function eventTypes()
    {

        $eventTypes = $this->db->exec('SELECT `id`, `type` FROM `event_types` ORDER BY `type`');

        return $eventTypes;
    }


    

}
