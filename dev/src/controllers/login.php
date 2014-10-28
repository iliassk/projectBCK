<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index() {
        $this-> getLoginView();
    }

    public function getLoginView() {
        $this->load->view("login_view");
    }

    /**
     * Check si la session est établie, le cas écheant, elle charge la vue members avec les infos de connexion du dev
     * sinon, redirige vers la vue login
     */
    public function members() {
        if($this->session->userdata("is_logged_in")) {
            $this->load->view("members_view");
        }
        else {
            redirect("../projectBCK/login/restricted");
        }
    }

    public function restricted() {
        $this->load->view("restricted_view");
    }

    public function validateLogin() {

        $this->load->library("form_validation");

        /**
         * required : Vérifie automatiquement si le champ est renseigné.
         * xss & trim : Applique des sécurités contre les failles xss & trim
         * sha1 : Crypte le MdP en sha1
         * callback_validate_credentials : Check les identifiants dans la BD
         */
        $this->form_validation->set_rules("nameDev", "\"Pseudo\"", "required|xss_clean|trim|callback_validate_credentials");
        $this->form_validation->set_rules("password", "\"Mot de passe\"", "required|sha1|xss_clean|trim");

        if($this->form_validation->run()) {
            /**
             * Début session avec la bibliothèque session en autoload (voir la clé d'encryption dans config)
             */
            $data_login = array(
                "nameDev" => $this->input->post("nameDev"),
                "is_logged_in" => true
            );
            $this->session->set_userdata($data_login);
            redirect("login/members");
        }
        else {
            $this->load->view("login_view");
        }

    }

    function validate_credentials() {
        $this->load->model("users_model");

        /**
         * Une deuxième, très mal codée, validation pour éviter que le callback se fait avant le form_validation
         */
        $this->load->library("form_validation");
        $this->form_validation->set_rules("nameDev", "\"Pseudo\"", "required|xss_clean|trim");
        $this->form_validation->set_rules("password", "\"Mot de passe\"", "required|sha1|xss_clean|trim");

        if($this->users_model->can_log_in() && $this->form_validation->run()) {
            return true;
        }
        else {
            $this->form_validation->set_message('validate_credentials', "Pseudo ou/et Mot de Passe incorrect(s).");
            return false;
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect("login");
    }
}