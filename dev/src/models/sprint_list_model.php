<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 07/11/14
 * Time: 15:10
 */

class Sprint_list_model extends CI_model {

    public function getSprints ($idPro) {
        return $this->db->query("SELECT DISTINCT idSprint FROM userstory WHERE idPro =".$idPro);
    }

} 