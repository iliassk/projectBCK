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
            $this->load->model("sprint_model");
            $dates = $this->sprint_model->getDates($idPro, $idSprint)->row_array();
            if ($dates == null)
                $array['dates'] = array ('date_debut' => 'AAAA-MM-JJ', 'date_fin' => 'AAAA-MM-JJ');
            else
                $array['dates'] = $dates;
            $this->load->view('sprint_view', $array);
        }
        else {
            redirect("../projectBCK/restricted");
        }
    }


    public function updateDates ($idPro, $idSprint, $update) {
        $this->load->model("contributors_model");
        if ($this->session->userdata("is_logged_in")
            and ($this->contributors_model->isDevInPro($idPro, $this->session->userdata('user_id'))->row() != null)) {

            $this->load->library("form_validation");
            $this->form_validation->set_rules('date_d', "début du sprint", 'required|callback_date_valid');
            $this->form_validation->set_rules('date_f', "fin du sprint", 'required|callback_date_valid');

            $this->form_validation->set_message('required', "Le champ \"%s\" est requis.");

            if ($this->form_validation->run()) {
                if ($this->compare_date( $this->input->post('date_d'), $this->input->post('date_f'))) {
                    $this->load->model("sprint_model");
                    if ($update)
                        $result = $this->sprint_model->setDates($idPro, $idSprint,
                            $this->input->post('date_d'), $this->input->post('date_f'));
                    else
                        $result = $this->sprint_model->addDates($idPro, $idSprint,
                            $this->input->post('date_d'), $this->input->post('date_f'));
                    if ($result == null)
                        echo '<script>alert("La modification des dates n\'est pas possible.");</script>';
                }
                else
                    echo '<script>alert("Le début du sprint est postérieur ou égal à la fin du sprint.");</script>';
            } else
                echo '<script>alert("La modification a échoué, veuillez vérifiez les dates.");</script>';
            $array = array('idPro' => $idPro, 'idSprint' => $idSprint , 'dates' => array
                        ('date_debut' => $this->input->post('date_d'), 'date_fin' => $this->input->post('date_f')));
            $this->load->view('sprint_view', $array);
        }

        else {
            redirect("../projectBCK/restricted");
        }
    }

    private function compare_date($date_debut, $date_fin) {
        if (new DateTime($date_debut) >= new DateTime($date_fin))
            return false;
        else
            return true;
    }

    // copied from gantt
    public function date_valid($date){
        return preg_match('#^(?P<year>\d{2}|\d{4})([- /.])(?P<month>\d{1,2})\2(?P<day>\d{1,2})$#', $date, $matches)
        && checkdate($matches['month'],$matches['day'],$matches['year']);
    }

} 