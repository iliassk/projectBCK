<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 26/10/14
 * Time: 15:15
 */

class Contributor_M extends CI_Model
{

    function addDev($idPro, $idDev)
    {
        return $this->$db->query("INSERT INTO dev_project (idDev, idPro, admin, scrumMaster, PO)
                VALUES (" . $idDev . ", " . $idPro . ", 0, 0, 0)");
    }

    function addDevFull($idPro, $idDev, $admin, $scrumM, $PO)
    {
        return $this->$db->query("INSERT INTO dev_project (idDev, idPro, admin, scrumMaster, PO)
                VALUES (" . $idDev . ", " . $idPro . ", " . $admin . "," . $scrumM . "," . $PO . ")");
    }

    function setPermission($idPro, $idDev, $admin, $scrumM, $PO)
    {
        return $this->$db->query("UPDATE dev_project SET admin =" . $admin . ", scrumMaster = " . $scrumM . ", PO =" . $PO .
            " WHERE idPro = " . $idPro . " AND idDev = " . $idDev);
    }

    function deleteDev($idPro, $idDev)
    {
        return $this->$db->query("DELETE FROM dev_project WHERE idPro = " . $idPro . " AND idDev = " . $idDev);
    }

    function getContributors($idPro)
    {
        return $this->$db->query("SELECT idDev, admin, scrumMaster, PO FROM dev_project WHERE idPro =" . $idPro);
    }

}