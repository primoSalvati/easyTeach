<?php

namespace Models;

class SettingsModel extends Model
{
  public function insertInstrument($addInstrument)
  {
    $instrumentInserted = $this->db->exec('INSERT INTO `instruments` (type) VALUES (?)',[$addInstrument]);
    return $instrumentInserted;
    /* se funziona, prova a fare lo stesso per event_types */
  }



    public function addStudent($name, $surname, $email, $telephone, $date_of_birth, $student_price, $student_source, $instrument, $lesson_length, $student_regularity): bool
    {
        if ($date_of_birth === '') {
            $date_of_birth = null;
        }

        $studentInserted = $this->db->exec('INSERT INTO `instruments` (name, surname, email, phone, date_of_birth, student_price, student_sources_id, instruments_id, lesson_length_id, student_regularity_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$name, $surname, $email, $telephone, $date_of_birth, $student_price, valOrNull($student_source), valOrNull($instrument), valOrNull($lesson_length), valOrNull($student_regularity)]);

        return $studentInserted;
    }
}