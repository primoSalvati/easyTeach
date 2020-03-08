<?php
namespace Models;

abstract class Model {
    protected $db;

    // TODO: Zugangsdaten in die init.php verlagern
    
       
    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        // DB Verbindung am Klassen Attribut speichern
        $this->db = new \DB\SQL(
            'mysql:host=localhost;port=3306;dbname=easyteach',
            'root',
            'root'
        );
    }
}

function valOrNull($val) {

        if(empty($val)) {
            return NULL;
        }

        return $val;
    }

    function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}


function dump_and_die($data) {
    echo '<pre>';
    var_dump($data);
    exit;
    echo '</pre>';
}

function dumpthisvalue($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}