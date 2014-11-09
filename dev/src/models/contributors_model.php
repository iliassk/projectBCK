<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 26/10/14
 * Time: 15:15
 */

class Contributors_model extends CI_Model
{

    public function getContributors($idPro)
    {
        return $this->db->query("SELECT dev_project.idDev, developper.nameDev, dev_project.admin, dev_project.scrumMaster,
                dev_project.PO FROM dev_project LEFT JOIN developper ON dev_project.idDev = developper.idDev
                WHERE dev_project.idPro =" . $idPro);
    }

    public function getIdDev($nameDev)
    {
        return $this->db->query("SELECT idDev FROM developper WHERE nameDev = '". $nameDev."'");
    }

    public function getDevPro($idPro, $idDev)
    {
        return $this->db->query("SELECT developper.nameDev, dev_project.admin, dev_project.scrumMaster, dev_project.PO
                FROM dev_project LEFT JOIN developper ON dev_project.idDev = developper.idDev
                WHERE dev_project.idpro =". $idPro ." AND dev_project.idDev =". $idDev);
    }

    public function isDevInPro($idPro, $idDev)
    {
       return $this->db->query("SELECT idDev FROM dev_project WHERE idPro =". $idPro." AND idDev =". $idDev);
    }

    public function addDev($idPro, $idDev, $admin, $scrumM, $PO)
    {
        return $this->db->query("INSERT INTO dev_project (idDev, idPro, admin, scrumMaster, PO)
                VALUES (" . $idDev . ", " . $idPro . ", " . $admin . "," . $scrumM . "," . $PO . ")");
    }

    public function setPermission($idPro, $idDev, $admin, $scrumM, $PO)
    {
        return $this->db->query("UPDATE dev_project SET admin =" . $admin . ", scrumMaster = " . $scrumM . ", PO =" . $PO .
                " WHERE idPro = " . $idPro . " AND idDev = " . $idDev);
    }

    public function deleteDev($idPro, $idDev)
    {
        return $this->db->query("DELETE FROM dev_project WHERE idPro = " . $idPro . " AND idDev = " . $idDev);
    }

}
