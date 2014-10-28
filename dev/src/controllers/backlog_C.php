<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 28/10/14
 * Time: 16:24
 */

class Backlog_C extends CI_Controller
{

    public function init($idPro)
    {
        $this->load->model("backlog_M", true);
        $result = $this->backlog_M->getBacklog($idPro);
        $this->load->view('backlog_V', $result);
    }

    public function addUs($idPro, $name, $cost) {
        
    }

}