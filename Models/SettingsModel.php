<?php

namespace Models;

class SettingsModel extends Model
{
  public function insertInstrument($insertInstrument) : bool
  {
    $instrumentInserted = $this->db->exec('INSERT INTO `instruments` (type) VALUES (?)',[$insertInstrument]);
    return $instrumentInserted;
    
  }

  public function deleteInstrument(int $id)
  {
    $isDeleted = $this->db->exec('DELETE FROM `instruments` WHERE `id` = ?', $id);
    return $isDeleted;
  }



}