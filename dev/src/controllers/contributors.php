<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 07/11/14
 * Time: 16:56
 */

class Contributors extends CI_Controller {

    public function index($idPro) {
        $this->load->model("contributors_model");
        if ($this->session->userdata("is_logged_in")
            and ($this->contributors_model->isDevInPro($idPro, $this->session->userdata('user_id'))->row() != null)) {
            $this->load->model("contributors_model");
            $devs = $this->contributors_model->getContributors($idPro)->result();
            $admin = $this->contributors_model->isDevAdmin($idPro, $this->session->userdata('user_id'))->row();
            $array = array('idPro' => $idPro, 'data' => $devs, 'admin' => $admin->admin);
            $this->load->view('contributors_view', $array);
        }
        else {
            redirect("../projectBCK/restricted");
        }
    }

    public function deleteDev($idPro, $idDev) {
        $this->load->model("contributors_model");
        if ($this->session->userdata("is_logged_in")
            and ($this->contributors_model->isDevInPro($idPro, $this->session->userdata('user_id'))->row() != null)
            and ($this->contributors_model->isDevAdmin($idPro, $this->session->userdata('user_id'))->row() != null)) {
            $this->load->model("contributors_model");
            $result = $this->contributors_model->deleteDev($idPro, $idDev);
            if ($result == false)
                echo '<script>alert("Impossible de supprimer le contributeur de ce projet");</script>';
            $this->index($idPro);
        }
        else {
            redirect("../projectBCK/restricted");
        }
    }

    public function setContributor($idPro, $idDev)
    {
        $this->load->model("contributors_model");
        if ($this->session->userdata("is_logged_in")
            and ($this->contributors_model->isDevInPro($idPro, $this->session->userdata('user_id'))->row() != null)
            and ($this->contributors_model->isDevAdmin($idPro, $this->session->userdata('user_id'))->row() != null)) {
            $array = array('idPro' => $idPro, 'idDev' => $idDev);
            if ($idDev == 0) {
                $array['url'] = 'contributors/addContributor/';
                $array['data'] = array('nameDev' => null, 'admin' => null, 'scrumMaster' => null, 'PO' => null);
            } else {
                $this->load->model("contributors_model");
                $result = $this->contributors_model->getDevPro($idPro, $idDev);
                $array['url'] = 'contributors/updateContributor/';
                $array['data'] = $result->row_array();
            }
            $this->load->view('setcontributor_view', $array);
        }
        else {
            redirect("../projectBCK/restricted");
        }
    }

    public function addContributor($idPro)
    {
        $this->load->model("contributors_model");
        if ($this->session->userdata("is_logged_in")
            and ($this->contributors_model->isDevInPro($idPro, $this->session->userdata('user_id'))->row() != null)
            and ($this->contributors_model->isDevAdmin($idPro, $this->session->userdata('user_id'))->row() != null)) {

            $this->load->library("form_validation");
            $this->form_validation->set_rules('nameDev', "nom du contributeur", 'required|xss_clean|trim');
            $this->form_validation->set_message('required', "Le champ \"%s\" est requis.");
            if($this->form_validation->run()) {

                if ($this->input->post('admin') == '')
                    $admin = '0';
                else $admin = $this->input->post('admin');
                if ($this->input->post('scrum') == '')
                    $scrum = '0';
                else $scrum = $this->input->post('scrum');
                if ($this->input->post('po') == '')
                    $po = '0';
                else $po = $this->input->post('po');

                $this->load->model("contributors_model");
                $result = $this->contributors_model->getIdDev($this->input->post('nameDev'))->row();
                if ($result != null) {
                   $idDev = $result->idDev;
                    $result = $this->contributors_model->isDevInPro($idPro, $idDev)->row();
                    if ($result != null)
                        echo  '<script>alert("Ce contributeur appartient déjà au projet.");</script>';
                    else {
                        $result = $this->contributors_model->addDev($idPro, $idDev, $admin, $scrum, $po);
                        if ($result == false)
                            echo  '<script>alert("L\'ajout du contributeur n\'est pas possible.");</script>';
                    }
                    $this->index($idPro);
                }
                else {
                    echo '<script>alert("Ce développeur n\'existe pas, veuillez vérifiez le nom du contributeur.");</script>';
                    $array = array('idPro' => $idPro, 'idDev' => null, 'url' => 'contributors/addContributor/',
                        'data' => array('nameDev' => $this->input->post('nameDev'), 'admin' => $this->input->post('admin'),
                            'scrumMaster' => $this->input->post('scrum'), 'PO' => $this->input->post('po')));
                    $this->load->view('setcontributor_view', $array);
                }
            }
            else {
                echo '<script>alert("L\'ajout a échoué, veuillez vérifiez le nom du contributeur.");</script>';

                $array = array('idPro' => $idPro, 'idDev' => null, 'url' => 'contributors/addContributor/',
                    'data' => array('nameDev' => $this->input->post('nameDev'), 'admin' => $this->input->post('admin'),
                        'scrumMaster' => $this->input->post('scrum'), 'PO' => $this->input->post('po')));
                $this->load->view('setcontributor_view', $array);
            }
        }
        else {
            redirect("../projectBCK/restricted");
        }
    }

    public function updateContributor($idPro, $idDev)
    {
        $this->load->model("contributors_model");
        if ($this->session->userdata("is_logged_in")
            and ($this->contributors_model->isDevInPro($idPro, $this->session->userdata('user_id'))->row() != null)
            and ($this->contributors_model->isDevAdmin($idPro, $this->session->userdata('user_id'))->row() != null)) {

            if ($this->input->post('admin') == '')
                $admin = '0';
            else $admin = $this->input->post('admin');
            if ($this->input->post('scrum') == '')
                $scrum = '0';
            else $scrum = $this->input->post('scrum');
            if ($this->input->post('po') == '')
                $po = '0';
            else $po = $this->input->post('po');

            $this->load->model("contributors_model");
            $result = $this->contributors_model->setPermission($idPro, $idDev, $admin, $scrum, $po);
            if ($result == false)
                echo '<script>alert("La modification du contributeur n\'est pas possible.");</script>';

            $this->index($idPro);
        }
        else {
            redirect("../projectBCK/restricted");
        }
    }

} 