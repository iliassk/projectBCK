<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        $this-> getLoginView();
    }

    public function getLoginView() {
        $this->load->view("login_view");
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
        $this->form_validation->set_rules("password", "\"Mot de passe\"", "required|xss_clean|trim|sha1");

        if($this->form_validation->run()) {
            /**
             * Début session avec la bibliothèque session en autoload (voir la clé d'encryption dans config)
             */

            $this->load->model("users_model");
            $data_login = array(
                "nameDev" => $this->input->post("nameDev"),
                "is_logged_in" => true,
                "user_id" => $this->users_model->get_idDev($this->input->post("nameDev"))
            );
            $this->session->set_userdata($data_login);
            redirect("projects");
        }
        else {
            $this->load->view("login_view");
        }

    }

    /**
     * @return bool
     * c'est la fonction qui fait la vérification pour le callback : callbac_validate_credentials
     */

    function validate_credentials() {
        $this->load->model("users_model");

        /**
         * Une deuxième, très mal codée, validation pour éviter que le callback se fait avant le form_validation
         */
        $this->load->library("form_validation");
        $this->form_validation->set_rules("nameDev", "\"Pseudo\"", "required|xss_clean|trim");
        $this->form_validation->set_rules("password", "\"Mot de passe\"", "required|xss_clean|trim|sha1");

        if($this->users_model->can_log_in() && $this->form_validation->run()) {
            return true;
        }
        else {
            $this->form_validation->set_message('validate_credentials', "Pseudo ou/et Mot de Passe incorrect(s).");
            return false;
        }
    }

    /**
     * On passe à la déconnexion
     */
    public function logout() {
        $this->load->helper("load_controller");
        load_controller("logout");
    }

    /**
     * On passe à l'inscription
     */
    public function register() {
        $this->load->helper("load_controller");
        load_controller("register");
    }
}