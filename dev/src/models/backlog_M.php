<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 26/10/14
 * Time: 14:20
 */


class Backlog_M extends CI_Model
{

    function addUS($idPro, $name, $cost)
    {
        return $this->$db->query("INSERT INTO userStory (idPro, nameUS, costUS)
              VALUES (" . $idPro . "," . $name . "," . $cost . ")");
    }

    function addUSFull($idPro, $name, $cost, $sprint)
    {
        return $this->$db->query("INSERT INTO userStory (idPro, nameUS, costUS, idSprint)
              VALUES (" . $idPro . "," . $name . "," . $cost . "," . $sprint . ")");
    }

    function setSprintUS($idUS, $sprint)
    {
        return $this->$db->query("UPDATE userStory SET idSprint =" . $sprint . " WHERE idUS = " . $idUS);
    }

    function setUS($idUS, $name, $cost, $sprint)
    {
        return $this->$db->query("UPDATE userStory SET nameUS = " . $name . ", costUS = " . $cost . ", idSprint =" . $sprint .
            " WHERE idUS = " . $idUS);
    }

    function deleteUS($idUS)
    {
        return $this->$db->query("DELETE FROM userStory WHERE idUS = " . $idUS);
    }

    function getBacklog($idPro)
    {
        return $this->$db->query("SELECT idUS, nameUS, costUS, sprint FROM userStory WHERE idPro =" . $idPro);
    }

}

