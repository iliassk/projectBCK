<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Register extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * On a utilisé le helper load_controller_helper pour accéder à la fonction index
     */
    public function index() {
        $this-> getRegisterView();
    }

    public function getRegisterView() {
        $this->load->view("register_view");
    }

    public function validateRegistration() {
        $this->load->library("form_validation");

        /**
         * Application des règles standards de vérification du pseudo, email, mdp ...
         */

        $this->form_validation->set_rules("nameDev", "\"Pseudo\"", "required|alpha_numeric|xss_clean|trim|is_unique[developper.nameDev]");
        $this->form_validation->set_rules("email", "\"Email\"", "required|xss_clean|trim|valid_email|is_unique[developper.email]");

        $this->form_validation->set_message("is_unique", " Ce %s est déjà inscrit. Veuillez vous connecter !");

        $this->form_validation->set_rules("password", "\"Mot de passe\"", "required|min_length[6]|max_length[15]|xss_clean|trim|sha1");
        $this->form_validation->set_rules("password_confirm", "\"Confirmer votre mot de passe\"", "required|xss_clean|trim|matches[password]|sha1");

        /**
         * Permet d'exécuter les vérification des champs du formulaire, insert les données dans la BD puis redirige vers "login"
         */
        if($this->form_validation->run()) {

            $this->load->model("registration_model");

            if($this->registration_model->addDev()) {
                echo '<script>alert("Merci pour votre inscription. Vous pouvez vous connectez maintenant !");</script>';
                redirect('login', 'refresh');
            }
            else {
                echo "Problème lors de l'ajout à la base de données. Contactez un admin.";
            }
        }
        else {
            /**
             * else : On re-affiche la page d'inscription en affichant les erreurs de validation
             */
            $this->load->view("register_view");
        }
    }
}