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

    public function get(){
        try{
            $this->load->model('tasks_model');
            $taskId = $this->security->xss_clean(strip_tags($this->input->post('id')));

            if($taskId == ""){
                throw new Exception("Task id is null".$taskId);
            }
            if(!is_numeric($taskId)){
                throw new Exception("Stop trying to mess with the API.");
            }

            $taskDescription = $this->tasks_model->getDescription($taskId);
            $post_data = array('message'=> 'Success!',
                'taskDescription' => $taskDescription,
                'isSuccessful'=> true);
            echo json_encode($post_data);
        }catch(Exception $e){

            $post_data = array('message'=> $e->getMessage(),
                'isSuccessful'=> false);
            echo json_encode($post_data);
        }
    }
}