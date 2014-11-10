<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 07/11/14
 * Time: 16:56
 */

class Contributors extends CI_Controller {

    public function index($idPro) {
        if ($this->session->userdata("is_logged_in")) {
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

        // test permission

        $result = $this->contributors_model->deleteDev($idPro, $idDev);
        if ($result == false)
            echo "Impossible de supprimer le contributeur de ce projet";
        $this->index($idPro);
    }

    public function setContributor($idPro, $idDev)
    {
        if ($this->session->userdata("is_logged_in")) {
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
                    echo "Ce contributeur appartient déjà au projet.";
                else {
                    $result = $this->contributors_model->addDev($idPro, $idDev, $admin, $scrum, $po);
                    if ($result == false)
                        echo "L'ajout du contributeur n'est pas possible.";
                }
            }
            else
                echo "Ce developpeur n'existe pas, veuillez vérifiez le nom du contributeur.";
        }
        else
            echo "L'ajout a échoué, veuillez vérifiez le nom du contributeur.";

        $this->index($idPro);
    }

    public function updateContributor($idPro, $idDev)
    {
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
            echo "La modification du contributeur n'est pas possible.";

        $this->index($idPro);
    }

} 