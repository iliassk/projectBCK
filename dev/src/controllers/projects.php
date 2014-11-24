<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// [Cpro]

class Projects extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->userdata("is_logged_in")) {
            $this->getProjectsListView();
        }
        else {
            redirect("../projectBCK/restricted");
        }
    }

    public function getProjectsListView()
    {
        $user_id = $this->session->userdata("user_id");
        $this->load->model("projects_model");
        $projects = $this->projects_model->getDevProjects($user_id);
        $data['projects'] = $projects;
        $this->load->view("projects_list_view", $data);

    }

    public function create_project()
    {
    	echo meta('Content-type', 'text/html; charset=utf-8', 'equiv');
        $this->load->library("form_validation");
        $this->form_validation->set_rules("namePro", "\"nom du projet\"", "required|xss_clean|trim|is_unique[project.namePro]");

        if($this->form_validation->run()) {

            $this->load->model("projects_model");

            $namePro = $this->input->post("namePro");
            $user_id = $this->session->userdata("user_id");

            if($this->projects_model->createProject($user_id, $namePro)) {

                echo '<script>alert("Nouveau projet créé");</script>';
                redirect('projects', 'refresh');
            }
            else {
                echo "Problème lors de l'ajout à la base de données. Contactez un admin.";
            }
        }
        else {

            echo '<script>alert("Nom de projet invalide");</script>';
            redirect('projects', 'refresh');

        }

    }

    public function delete_project($idPro)
    {
        $this->load->model("projects_model");

        $this->projects_model->removeProject($idPro);
        redirect('projects', 'refresh');
    }

    public function project_page($namePro)
    {
    	echo meta('Content-type', 'text/html; charset=utf-8', 'equiv');
        echo "Vous êtes sur la page du projet : ". $namePro;

    }
}

// [end Cpro]
