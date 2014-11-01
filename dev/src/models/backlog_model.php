<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 26/10/14
 * Time: 14:20
 */


class Backlog_model extends CI_Model
{

    public function getBacklog($idPro)
    {
        return $this->db->query("SELECT idUS, nameUS, costUS, idSprint FROM userstory WHERE idPro =" . $idPro);
    }

    public function addUS($idPro, $name, $cost, $sprint)
    {
        return $this->db->query("INSERT INTO userstory (idPro, nameUS, costUS, idSprint)
              VALUES (" . $idPro . "," . $name . "," . $cost . "," . $sprint . ")");
    }

    public function deleteUS($idUS)
    {
        return $this->db->query("DELETE FROM userstory WHERE idUS = " . $idUS);
    }

    public function setSprintUS($idUS, $sprint)
    {
        return $this->db->query("UPDATE userstory SET idSprint =" . $sprint . " WHERE idUS = " . $idUS);
    }

    public function setUS($idUS, $name, $cost, $sprint)
    {
        return $this->db->query("UPDATE userstory SET nameUS = " . $name . ", costUS = " . $cost . ", idSprint =" . $sprint .
            " WHERE idUS = " . $idUS);
    }

}

