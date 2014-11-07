<?php

class Registration_model extends CI_Model {

    public function addDev() {

        $data_signup = array(
            "nameDev" => $this->input->post("nameDev"),
            "email" => $this->input->post("email"),
            "password" => $this->input->post("password")
        );

        $query = $this->db->insert("developper", $data_signup);
        if($query) {
            return true;
        }
        else {
            return false;
        }

    }
}