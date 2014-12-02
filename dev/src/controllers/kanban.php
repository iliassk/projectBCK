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
            backlog,
            in progress,
            done
        */
        $backlogTasks = $this->tasks_model->getTasksByType($idPro, $idSprint, 'To Do');
        $inProgressTasks = $this->tasks_model->getTasksByType($idPro, $idSprint, 'In Progress');
        $doneTasks = $this->tasks_model->getTasksByType($idPro, $idSprint, 'Done');


        $data['requirejs'] = base_url().'/requirejs/views/pages/view/index.js';

        $data['backlogHtml'] = $this->generateBoardCards($backlogTasks, $idPro.'-'.$idSprint.'-'.'To Do', 'To Do');
        $data['inProgressHtml'] = $this->generateBoardCards($inProgressTasks, $idPro.'-'.$idSprint.'-'.'In Progress', 'In Progress');
        $data['doneHtml'] = $this->generateBoardCards($doneTasks, $idPro.'-'.$idSprint.'-'.'Done', 'Done');
        $data['idSprint'] = $idSprint;

        $this->load->view('kanban_view', $data);
    }

    private function generateBoardCards($backlogTasks, $id, $typeOfTasks){
        $this->load->model('users_model');
        $html = "";
        $html .= '<ul id="card'.$id.'" class="card card-container panel panel-primary" data-id="'.$id.'" >'.
            '<div class="card-name panel-heading">'.
            '<label class="card-name-label">'.
            $typeOfTasks.
            '</label>'.
            '<div class="menu pull-right">
                    <div class="btn-group">
                    </div>
                </div>'.
            '</div>'.
            '<div class="card-name-input panel-heading" style="display:none;">'.
            '<input type="text" class="card-name-update" id="cardNameUpdate" placeholder="Name" value="'.$typeOfTasks.'">'.
            '</div>'.
            '<div class="panel-body">'.
            "<ul class='tasks'>";
        //now loop through to retrieve all the tasks for the cards..
        foreach($backlogTasks->result() as $taskRow){
            $html .= "<li id='task".$taskRow->idTask."' class='task' data-id='".$taskRow->idTask."' data-order='".$taskRow->order."' href='#detailedTask'>";
            $html .= '<span class="title-content">';
            $html .= htmlentities($taskRow->nameTask).'';
            $html .= '</span>';

            $html .= "<div class='task-user-container'>";
            $html .= "<span class='task-user-".$taskRow->idDev."'>";
            //$html .= $taskRow->idDev." ";
            $html .= $this->users_model->get_nameDev($taskRow->idDev)." ";
            $html .= "</span>";
            $html .= "</div>";

            $html .= "</li>";
        }

        $html .= "</ul>".
            '</div>'.
            '<div class="add-task-input-container panel-footer" style="display:none;">'.
            '<textarea class="add-task-input" id="addTaskInput" placeholder="Task"></textarea>'.
            '</div>'.
            '</ul>';

        return $html;
    }


}
