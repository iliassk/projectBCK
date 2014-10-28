<?php

class Users_model extends CI_Model {

    public function can_log_in() {
        $this->db->where("nameDev", $this->input->post("nameDev"));
        $this->db->where("password", sha1($this->input->post("password")));

        /**
         * SELECT de tous les champs de developper
         */
        $query = $this->db->get("developper");
        if($query->num_rows() == 1) {
            return true;
        }
        else {
            return false;
        }
    }
}