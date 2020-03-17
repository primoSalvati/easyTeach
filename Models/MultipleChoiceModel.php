<?php

namespace Models;

class MultipleChoiceModel extends Model
{


    /**
     * studentSources
     *
     * @return array
     */
    public function studentSources(): array
    {
        $studentSources = $this->db->exec('SELECT * FROM `student_sources` ORDER BY `source`');

        return $studentSources;
    }

    /**
     * allInstruments
     *
     * @return array
     */
    public function allInstruments(): array
    {
        $instruments = $this->db->exec('SELECT * FROM `instruments` ORDER BY `type`');

        return $instruments;
    }

    /**
     * lessonLength
     *
     * @return array
     */
    public function lessonLength(): array
    {
        $lessonLength = $this->db->exec('SELECT * FROM `lesson_length`');
        return $lessonLength;
    }


    /**
     * studentRegularity
     *
     * @return array
     */
    public function studentRegularity(): array
    {
        $studentRegularity = $this->db->exec('SELECT * FROM `student_regularity`');

        return $studentRegularity;
    }
    
    /**
     * studentList. this function is meant to put the students on a select box when inserting/updating a lesson, as a usability feature
     *
     * @return array
     */
    public function studentList(): array
    {

        $studentList = $this->db->exec('SELECT `id`, `name`, `surname` FROM `students`');

        return $studentList;
    }

    /**
     * eventTypes
     *
     * @return array
     */
    public function eventTypes(): array
    {

        $eventTypes = $this->db->exec('SELECT `id`, `type` FROM `event_types`');

        return $eventTypes;
    }

    
}
