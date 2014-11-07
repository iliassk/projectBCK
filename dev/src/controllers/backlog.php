<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 28/10/14
 * Time: 16:24
 */


class Backlog extends CI_Controller
{

    public function init($idPro)
    {
        $this->load->model("backlog_model");
        $backlog = $this->backlog_model->getBacklog($idPro);
        $array = array('idPro' => $idPro, 'data' => $backlog->result());
        $this->load->view('backlog_view', $array);

    }


    public function ValidateUS()
    {
        $this->load->library("form_validation");

        $this->form_validation->set_rules('nameUS', "nom de l'US", 'required');
        $this->form_validation->set_rules('costUS', "coût de l'US", 'required|Integer');
        $this->form_validation->set_rules('idSprint', "sprint associé", 'Integer');
        // add constraint less_than for sprint when project_model implemented

        $this->form_validation->set_message('required', "Le champ \"%s\" est requis.");
        $this->form_validation->set_message('Integer', "Le champ \"%s\" doit contenir un entier.");
        return $this->form_validation->run();

    }

    public function setUS($idPro, $idUS)
    {
        $this->load->model("backlog_model");
        if ($idUS == 0) {
            $array = array('url' => 'backlog/addUS/', 'idPro' => $idPro,
                            'data' => array('idUS' => null, 'nameUS' => null, 'costUS' => null, 'idSprint' => null));
        }
        else {
            $us = $this->backlog_model->getUS($idUS);
            $array = array('url' => 'backlog/updateUS/','idPro' => $idPro, 'data' => $us->row_array() );

        }
        $this->load->view("setus_view", $array);
    }

    public function addUS($idPro)
    {

        if($this->validateUS()) {
            $this->load->model("backlog_model");
            $idSprint = $this->input->post('idSprint');
            if ($idSprint == '')
                $idSprint = 'null';

            $result = $this->backlog_model->addUS($idPro, $this->input->post('nameUS'),
                $this->input->post('costUS'), $idSprint);
            if ($result == false)
                echo "L'ajout dans la base de donnée n'est pas possible.";
        }
        else
            echo "L'ajout a échoué, veuillez vérifiez le contenu des champs.";

        $this->init($idPro);

    }

    public function updateUS($idPro, $idUS)
    {
        if ($this->validateUS()) {
            $this->load->model("backlog_model");
            $idSprint = $this->input->post('idSprint');
            if ($idSprint == '')
                $idSprint = 'null';

            $result = $this->backlog_model->setUS($idUS, $this->input->post('nameUS'),
                $this->input->post('costUS'), $idSprint);
            if ($result == false)
                echo "La modification de l'US n'est pas possible.";
        }
        else
            echo "La modification a échoué, veuillez vérifiez le contenu des champs.";

        $this->init($idPro);
    }


    public function deleteUS($idPro, $idUS)
    {
        $this->load->model("backlog_model");
        $result = $this->backlog_model->deleteUS($idUS);
        if ($result == false)
            echo "Impossible de supprimer l'US";

        $this->init($idPro);
    }


}