<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Task extends CI_Controller {
    public function __construct(){
        parent::__construct();
    }

    public function index() {
    }

  	public function update_order(){
  		$this->load->model('tasks_model');
		$tasks = json_decode($_POST['tasks']);
		$this->tasks_model->updateTaskOrder($tasks);	
  	}  

  	public function update_description(){
  		$this->load->model('tasks_model');
  		error_log('description2 '.$this->input->post('description').'....');
  	}
}