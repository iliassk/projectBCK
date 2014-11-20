<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 07/11/14
 * Time: 15:16
 */

class Sprint_list extends CI_Controller {

    public function index ($idPro) {
        $this->load->model("contributors_model");
        if ($this->session->userdata("is_logged_in")
            and ($this->contributors_model->isDevInPro($idPro, $this->session->userdata('user_id'))->row() != null)) {
            $this->load->model("sprint_list_model");
            $sprints = $this->sprint_list_model->getSprints($idPro);
            $array = array('idPro' => $idPro, 'data' => $sprints->result());
            $this->load->view('sprint_list_view', $array);
        }
        else {
            redirect("../projectBCK/restricted");
        }
    }

} 