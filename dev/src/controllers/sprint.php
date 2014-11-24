<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 20/11/14
 * Time: 17:48
 */

class Sprint extends CI_Controller {

    public function index ($idPro, $idSprint) {
        $this->load->model("contributors_model");
        if ($this->session->userdata("is_logged_in")
            and ($this->contributors_model->isDevInPro($idPro, $this->session->userdata('user_id'))->row() != null)) {
            $array = array('idPro' => $idPro, 'idSprint' => $idSprint );
            $this->load->view('sprint_view', $array);
        }
        else {
            redirect("../projectBCK/restricted");
        }
    }

} 