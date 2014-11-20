<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Check si la session est établie, le cas écheant, elle charge la vue "dashboard" avec les infos de connexion du dev
     * sinon, redirige vers la vue restricted
     */
    public function index()
    {
        if ($this->session->userdata("is_logged_in")) {
            $this->getDashboardView();
        }
        else {
            redirect("../projectBCK/restricted");
        }
    }

    public function getDashboardView() {
        // Ceci n'est fait que pour effectuer des tests, ne jamais accéder à la BD depuis le controller !!!
        $idProject = $this->uri->segment(2);
        $this->db->select("idPro");
        $this->db->select("namePro");
        $this->db->from("project");
        $this->db->where("idPro", $idProject);
        $data_project["query"] =  $this->db->get();
        $this->load->view("dashboard_view", $data_project);
    }

}