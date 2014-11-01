<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 28/10/14
 * Time: 16:24
 */


class Backlog extends CI_Controller
{
    private $idPro;

    public function init($idPro)
    {
        $this->idPro = $idPro;
        $this->load->model("backlog_model");
        $backlog = $this->backlog_model->getBacklog($this->idPro);
        $data['results'] = $backlog->result();
        $this->load->view('backlog_view', $data);

    }

    public function ValidateUS($nameUS, $costUS, $idSprint) {
        // check forms
        //call addUS
    }

    private function addUS($nameUS, $costUS, $idSprint)
    {
        $this->load->model("backlog_model");
        $result = $this->backlog_model->addUS($this->idPro, $nameUS, $costUS, $idSprint);
        // print error message ?
        $backlog = $this->backlog_model->getBacklog($this->idPro);
        $data['results'] = $backlog->result();
        $this->load->view('backlog_view', $data);

    }

    public function deleteUS($idUS) {
        $this->load->model("backlog_model");
        $result = $this->backlog_model->deleteUS($idUS);
        // print error message ?
        $backlog = $this->backlog_model->getBacklog($this->idPro);
        $data['results'] = $backlog->result();
        $this->load->view('backlog_view', $data);
    }

    // add sets


    public function test () {
        echo "test";
    }

}