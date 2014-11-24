<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Kanban extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index($idPro, $idSprint) {
    	//get tasks...
    	$this->load->model('tasks_model');
    	/*
			todo,
			in progress,
			done
    	*/
    	$backlogTasks = $this->tasks_model->getTasksByType($idPro, $idSprint, 'Backlog');
    	$inProgressTasks = $this->tasks_model->getTasksByType($idPro, $idSprint, 'InProgress');
    	$doneTasks = $this->tasks_model->getTasksByType($idPro, $idSprint, 'Done');


    	$data['requirejs'] = base_url().'/requirejs/views/pages/view/index.js';

    	$data['backlogHtml'] = $this->generateBoardCards($backlogTasks, $idPro.'-'.$idSprint.'-'.'Backlog', 'Backlog');
    	$data['inProgressHtml'] = $this->generateBoardCards($inProgressTasks, $idPro.'-'.$idSprint.'-'.'InProgress', 'InProgress');
    	$data['doneHtml'] = $this->generateBoardCards($doneTasks, $idPro.'-'.$idSprint.'-'.'Done', 'Done');


        $this->load->view('kanban/index', $data);
    }


}
