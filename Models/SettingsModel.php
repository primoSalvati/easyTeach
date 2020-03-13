<?php

namespace Models;

class SettingsModel extends Model
{
  public function insertInstrument($addInstrument)
  {
    $instrumentInserted = $this->db->exec('INSERT INTO `instruments` (type) VALUES (?)',[$addInstrument]);
    return $instrumentInserted;
    
  }



}