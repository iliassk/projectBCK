<?php

//[Ctest_affich]

class Tests extends CI_Controller
{

    public function index($idPro, $idSprint)
    {
        $this->testsList($idPro, $idSprint);
    }

    public function testsList($idPro, $idSprint)
    {
        $this->load->model("tests_model");
        $testsInfos = $this->tests_model->getTestsInfos($idPro, $idSprint);

        $data['testsInfos'] = $testsInfos;
        $data['idPro'] = $idPro;
        $data['idSprint'] = $idSprint;

        $this->load->view('tests_list_view', $data);

    }
    //[end Ctest_affich]

    //[Ctest_modif]

    public function setTest($idPro, $idSprint, $idTask){
        $this->load->model("contributors_model");
        if ($this->session->userdata("is_logged_in")
            and ($this->contributors_model->isDevInPro($idPro, $this->session->userdata('user_id'))->row() != null)) {
            $this->load->model("tests_model");
            $test = $this->tests_model->getTestInfos($idTask);
            $devs = $this->contributors_model->getContributors($idPro);
            $array = array('idPro' => $idPro, 'idSprint' => $idSprint, 'idTask'=> $idTask ,
                            'test' => $test->row(), 'devs' => $devs->result());
            $this->load->view("settest_view", $array);
        }
        else {
            redirect("../projectBCK/restricted");
        }
    }

    public function updateTest($idPro, $idSprint, $idTask) {
        $this->load->model("contributors_model");
        if ($this->session->userdata("is_logged_in")
            and ($this->contributors_model->isDevInPro($idPro, $this->session->userdata('user_id'))->row() != null)) {

            $this->load->library("form_validation");
            $this->form_validation->set_rules('dev', "nom du développeur", 'required');
            $this->form_validation->set_rules('date', "date", 'required|callback_date_valid');
            $this->form_validation->set_rules('result', "résultat", 'required');

            $this->form_validation->set_message('required', "Le champ \"%s\" est requis.");

            if ($this->form_validation->run()) {
                $this->load->model("tests_model");
                $result = $this->tests_model->updateTest($idTask, $this->input->post('dev'),
                    $this->input->post('date'), $this->input->post('result'));
                if ($result == null)
                    echo '<script>alert("La modification du test n\'est pas possible.");</script>';
            } else
                echo '<script>alert("La modification a échoué, veuillez vérifiez le contenu des champs.");</script>';

            $this->index($idPro, $idSprint);
        }

        else {
            redirect("../projectBCK/restricted");
        }

    }

    // copied from gantt
    public function date_valid($date){
        return preg_match('#^(?P<year>\d{2}|\d{4})([- /.])(?P<month>\d{1,2})\2(?P<day>\d{1,2})$#', $date, $matches)
        && checkdate($matches['month'],$matches['day'],$matches['year']);
    }


    //[end Ctest_modif]
}

