<?php

namespace Models;

class SettingsModel extends Model
{

  /**
   * insertInstrument 
   *
   * @param mixed $insertInstrument
   * 
   * @return bool
   */
  public function insertInstrument($instrument): bool
  {
    $instrumentInserted = $this->db->exec('INSERT INTO `instruments` (type) VALUES (?)', [$instrument]);
    return $instrumentInserted;
  }

  /**
   * deleteInstrument
   *
   * @param integer $id
   * 
   * @return bool
   */
  public function deleteInstrument(int $id): bool
  {
    $isDeleted = $this->db->exec('DELETE FROM `instruments` WHERE `id` = ?', $id);
    return $isDeleted;
  }



  /**
   * insertEventType
   *
   * @param mixed $eventType
   * 
   * @return bool
   */
  public function insertEventType($eventType): bool
  {
    $eventTypeInserted = $this->db->exec('INSERT INTO `event_types` (type) VALUES (?)', [$eventType]);
    return $eventTypeInserted;
  }
  /**
   * deleteEventType
   *
   * @param integer $id
   * 
   * @return bool
   */
  public function deleteEventType(int $id): bool
  {
    $isDeleted = $this->db->exec('DELETE FROM `event_types` WHERE `id` = ?', $id);
    return $isDeleted;
  }




  /**
   * insertStudentSource
   *
   * @param mixed $studentSource
   * 
   * @return bool
   */
  public function insertStudentSource($studentSource): bool
  {
    $studentSourceInserted = $this->db->exec('INSERT INTO `student_sources` (source) VALUES (?)', [$studentSource]);
    return $studentSourceInserted;
  }
  /**
   * deleteStudentSource
   *
   * @param integer $id
   * 
   * @return bool
   */
  public function deleteStudentSource(int $id): bool
  {
    $isDeleted = $this->db->exec('DELETE FROM `student_sources` WHERE `id` = ?', $id);
    return $isDeleted;
  }



  /**
   * insertLessonLength
   *
   * @param mixed $lessonLength
   * 
   * @return bool
   */
  public function insertLessonLength($lessonLength): bool
  {
    $lessonLengthInserted = $this->db->exec('INSERT INTO `lesson_length` (length) VALUES (?)', [$lessonLength]);
    return $lessonLengthInserted;
  }
  /**
   * deleteLessonLength
   *
   * @param integer $id
   * 
   * @return bool
   */
  public function deleteLessonLength(int $id): bool
  {
    $isDeleted = $this->db->exec('DELETE FROM `lesson_length` WHERE `id` = ?', $id);
    return $isDeleted;
  }



  /**
   * insertStudentRegularity
   *
   * @param mixed $studentRegularity
   * 
   * @return bool
   */
  public function insertStudentRegularity($studentRegularity): bool
  {
    $studentRegularityInserted = $this->db->exec('INSERT INTO `student_regularity` (type) VALUES (?)', [$studentRegularity]);
    return $studentRegularityInserted;
  }

  /**
   * deleteStudentRegularity
   *
   * @param integer $id
   * 
   * @return bool
   */
  public function deleteStudentRegularity(int $id): bool
  {
    $isDeleted = $this->db->exec('DELETE FROM `student_regularity` WHERE `id` = ?', $id);
    return $isDeleted;
  }


}
