<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 28/11/14
 * Time: 14:42
 */

class Sprint_model extends CI_Model {

    public function getDates ($idPro, $idSprint) {
        return $this->db->query("SELECT date_debut, date_fin FROM sprint WHERE idPro = ".$idPro
            ." AND idSprint = ".$idSprint);
    }

    public function addDates($idPro, $idSprint, $date_debut, $date_fin) {
        return $this->db->query("INSERT INTO sprint (idPro, idSprint, date_debut, date_fin) VALUES ("
            . $idPro .",". $idSprint .",'". $date_debut ."','". $date_fin ."')");
    }

    public function setDates($idPro, $idSprint, $date_debut, $date_fin) {
        return $this->db->query("UPDATE sprint SET date_debut = '". $date_debut ."', date_fin = '". $date_fin
            ."' WHERE idPro = ". $idPro ." AND idSprint = ". $idSprint);
    }

} 