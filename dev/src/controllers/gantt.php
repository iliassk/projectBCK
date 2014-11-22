<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 14/11/14
 * Time: 14:30
 */

class Gantt extends CI_Controller {

    public function index($idPro, $idSprint)
    {
        $this->load->model("contributors_model");
        if ($this->session->userdata("is_logged_in")
            and ($this->contributors_model->isDevInPro($idPro, $this->session->userdata('user_id'))->row() != null)) {
            $this->load->model("gantt_model");
            $gantt = $this->gantt_model->getGantt($idPro, $idSprint);
            $array = array('idPro' => $idPro, 'idSprint' => $idSprint, 'data' => $gantt->result());
            $this->load->view('gantt_view', $array);
        }
        else {
            redirect("../projectBCK/restricted");
        }
    }

    public function setGantt($idPro, $idSprint)
    {
        $this->load->model("contributors_model");
        if ($this->session->userdata("is_logged_in")
            and ($this->contributors_model->isDevInPro($idPro, $this->session->userdata('user_id'))->row() != null)) {
            $this->load->model("gantt_model");
            $tasks = $this->gantt_model->getTasks($idPro, $idSprint);
            $devs = $this->contributors_model->getContributors($idPro);
            $array = array('idPro' => $idPro, 'idSprint' => $idSprint, 'tasks' => $tasks->result(), 'devs' => $devs->result());
            $this->load->view("setgantt_view", $array);
        }
        else {
            redirect("../projectBCK/restricted");
        }
    }

    public function updateGantt($idPro, $idSprint)
    {
        $this->load->model("contributors_model");
        if ($this->session->userdata("is_logged_in")
            and ($this->contributors_model->isDevInPro($idPro, $this->session->userdata('user_id'))->row() != null)) {

            $this->load->library("form_validation");
            $this->form_validation->set_rules('tasks', "nom de la tâche", 'required');
            $this->form_validation->set_rules('devs', "nom du développeur", 'required');
            $this->form_validation->set_rules('date', "date", 'required|callback_date_valid');

            $this->form_validation->set_message('required', "Le champ \"%s\" est requis.");

            if ($this->form_validation->run()) {

                $this->load->model("gantt_model");
                $result = $this->gantt_model->isTaskInGantt($this->input->post('devs'), $this->input->post('tasks'),
                    $this->input->post('date'))->result();
                if ($result == null) {
                    $result = $this->gantt_model->addTask($this->input->post('devs'), $this->input->post('tasks'),
                        $this->input->post('date'));
                    if ($result == null)
                        echo '<script>alert("La modification du gantt n\'est pas possible.");</script>';
                }
                else
                    echo '<script>alert("Cette entrée est déjà présente de le Gantt.");</script>';
            }
            else
                echo '<script>alert("La modification a échoué, veuillez vérifiez le contenu des champs.");</script>';

            $this->index($idPro, $idSprint);
        }
        else {
            redirect("../projectBCK/restricted");
        }
    }

    // called by form_validation on date
    public function date_valid($date){
        return preg_match('#^(?P<year>\d{2}|\d{4})([- /.])(?P<month>\d{1,2})\2(?P<day>\d{1,2})$#', $date, $matches)
            && checkdate($matches['month'],$matches['day'],$matches['year']);
    }

    public function deleteFromGantt($idPro, $idSprint, $idDev, $idTask, $date) {
        $this->load->model("contributors_model");
        if ($this->session->userdata("is_logged_in")
            and ($this->contributors_model->isDevInPro($idPro, $this->session->userdata('user_id'))->row() != null)) {
            $this->load->model("gantt_model");
            $result = $this->gantt_model->removeTask($idDev, $idTask, $date);
            if ($result == false)
                echo '<script>alert("Impossible de modifier le gantt.")</script>';

            $this->index($idPro, $idSprint);
        }
        else {
            redirect("../projectBCK/restricted");
        }
    }


} 