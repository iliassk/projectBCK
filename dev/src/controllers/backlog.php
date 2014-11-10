<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 28/10/14
 * Time: 16:24
 */


class Backlog extends CI_Controller
{

    public function index($idPro)
    {
        $this->load->model("contributors_model");
        if ($this->session->userdata("is_logged_in")
            and ($this->contributors_model->isDevInPro($idPro, $this->session->userdata('user_id'))->row() != null)) {
            $this->load->model("backlog_model");
            $backlog = $this->backlog_model->getBacklog($idPro);
            $array = array('idPro' => $idPro, 'data' => $backlog->result());
            $this->load->view('backlog_view', $array);
        }
        else {
            redirect("../projectBCK/restricted");
        }
    }

    private function ValidateUS()
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
        $this->load->model("contributors_model");
        if ($this->session->userdata("is_logged_in")
            and ($this->contributors_model->isDevInPro($idPro, $this->session->userdata('user_id'))->row() != null)) {
            if ($idUS == 0) {
                $array = array('url' => 'backlog/addUS/', 'idPro' => $idPro,
                    'data' => array('idUS' => null, 'nameUS' => null, 'costUS' => null, 'idSprint' => null));
            } else {
                $this->load->model("backlog_model");
                $us = $this->backlog_model->getUS($idUS);
                $array = array('url' => 'backlog/updateUS/', 'idPro' => $idPro, 'data' => $us->row_array());

            }
            $this->load->view("setus_view", $array);
        }
        else {
            redirect("../projectBCK/restricted");
        }

    }

    public function addUS($idPro)
    {
        $this->load->model("contributors_model");
        if ($this->session->userdata("is_logged_in")
            and ($this->contributors_model->isDevInPro($idPro, $this->session->userdata('user_id'))->row() != null)) {
            if ($this->validateUS()) {
                $this->load->model("backlog_model");
                $idSprint = $this->input->post('idSprint');
                if ($idSprint == '')
                    $idSprint = 'null';

                $result = $this->backlog_model->addUS($idPro, $this->input->post('nameUS'),
                    $this->input->post('costUS'), $idSprint);
                if ($result == false)
                    echo '<script>alert("L\'ajout dans la base de donnée n\'est pas possible");</script>';
                $this->index($idPro);
            }
            else {
                echo '<script>alert("L\'ajout a échoué, veuillez vérifiez le contenu des champs.");</script>';
                $array = array('url' => 'backlog/addUS/', 'idPro' => $idPro,
                            'data' => array('idUS' => null, 'nameUS' => $this->input->post('nameUS'),
                                'costUS' => $this->input->post('costUS'), 'idSprint' => $this->input->post('idSprint')));
                $this->load->view("setus_view", $array);
            }

        }
        else {
                redirect("../projectBCK/restricted");
            }
    }

    // ajout n cas d'echec -> rester sur setUS

    public function updateUS($idPro, $idUS)
    {
        $this->load->model("contributors_model");
        if ($this->session->userdata("is_logged_in")
            and ($this->contributors_model->isDevInPro($idPro, $this->session->userdata('user_id'))->row() != null)) {
            if ($this->validateUS()) {
                $this->load->model("backlog_model");
                $idSprint = $this->input->post('idSprint');
                if ($idSprint == '')
                    $idSprint = 'null';

                $result = $this->backlog_model->setUS($idUS, $this->input->post('nameUS'),
                    $this->input->post('costUS'), $idSprint);
                if ($result == false)
                    echo '<script>alert("La modification de l\'US n\'est pas possible.");</script>';
                $this->index($idPro);
            }
            else {
                echo '<script>alert("La modification a échoué, veuillez vérifiez le contenu des champs.");</script>';
                $array = array('url' => 'backlog/updateUS/', 'idPro' => $idPro,
                    'data' => array('idUS' => $idUS, 'nameUS' => $this->input->post('nameUS'),
                        'costUS' => $this->input->post('costUS'), 'idSprint' => $this->input->post('idSprint')));
                $this->load->view("setus_view", $array);
            }
        }
        else {
            redirect("../projectBCK/restricted");
        }
    }


    public function deleteUS($idPro, $idUS)
    {
        $this->load->model("contributors_model");
        if ($this->session->userdata("is_logged_in")
            and ($this->contributors_model->isDevInPro($idPro, $this->session->userdata('user_id'))->row() != null)) {
            $this->load->model("backlog_model");
            $result = $this->backlog_model->deleteUS($idUS);
            if ($result == false)
                echo '<script>alert("Impossible de supprimer l\'US";)</script>';

            $this->index($idPro);
        }
        else {
            redirect("../projectBCK/restricted");
        }
    }


}