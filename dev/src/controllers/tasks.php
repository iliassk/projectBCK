<?php


class Tasks extends CI_Controller
{

    public function init($idPro, $idSprint)
    {

        $tasks_list = $this->getTasksList($idPro, $idSprint);
        $tasksDependIdName = $this->getTasksDependIdName($tasks_list);


        $data['tasks'] = $tasks_list;
        $data['idPro'] = $idPro;
        $data['idSprint'] = $idSprint;
        $data['taskDependIdName'] = $tasksDependIdName;

        $this->load->view('tasks_list_view', $data);

    }


    public function ValidateTask()
    {
        $this->load->library("form_validation");

        $this->form_validation->set_rules('nameTask', "nom de la tâche", 'required');
        $this->form_validation->set_rules('descriptionTask', "description de la tâche", 'required');
        $this->form_validation->set_rules('costTask', "coût de la tâche", 'required|Integer');
        $this->form_validation->set_rules('nameUS', "US associée", '');
        // add constraint less_than for sprint when project_model implemented

        $this->form_validation->set_message('required', "Le champ \"%s\" est requis.");
        $this->form_validation->set_message('Integer', "Le champ \"%s\" doit contenir un entier.");
        return $this->form_validation->run();

    }

    public function setTask($idPro, $idSprint, $idUS, $idTask)
    {
        $this->load->model("tasks_model");
        if ($idTask == 0) {
            $data = array('url' => 'tasks/addTask/' .$idPro.'/'.$idSprint. '/' .$idUS, 'idPro' => $idPro, 'idSprint' => $idSprint, 'idUS' => 0, 'idTask' => $idTask,
                'data' => array('idTask' => null, 'nameTask' => null, 'costTask' => null, 'descriptionTask' => null, 'taskDepend' => null),
                'taskDependName' => null);
        } else {
            $task = $this->tasks_model->getTask($idTask);
            $data = array('url' => 'tasks/updateTask/' .$idPro. '/' .$idSprint. '/' .$idTask, 'idPro' => $idPro, 'idSprint' => $idSprint, 'idUS' => $idUS, 'idTask' => $idTask,
                'data' => $task,
                'taskDependName' => $this->getTasksDependIdName($this->getTasksList($idPro, $idSprint))[$task['taskDepend']]);

        }
        $this->load->view("set_task_view", $data);
    }


    public function addTask($idPro, $idSprint)
    {

        if ($this->validateTask()) {
            $this->load->model("tasks_model");

            // mise en forme des entrée dans la bd
            $is_test = $this->input->post('is_test');
            if ($is_test == 'accept')
                $is_test = 1;
            else
                $is_test = 0;

            $idUS = $this->input->post('idUS');
            if($idUS == null)
                $idUS = 0;

            //ajout de la tache dans la bd
            $result = $this->tasks_model->addTask($this->input->post('nameTask'), $this->input->post('descriptionTask'), $idUS, $this->input->post('costTask'), $is_test,
                $this->tasks_model->getTaskId($this->input->post('TaskDependName')));
            if ($result == false)
                echo "L'ajout dans la base de donnée n'est pas possible.";
        } else
            echo "L'ajout a échoué, veuillez vérifiez le contenu des champs.";

        $this->init($idPro, $idSprint);

    }


    public function updateTask($idPro, $idSprint, $idTask)
    {
        if ($this->validateTask()) {
            $this->load->model("tasks_model");

            // mise en forme des entrée dans la bd
            $idUS = $this->input->post('idUS');
            if($idUS == null)
                $idUS = 0;

            //modifiaction de la tache dans la bd
            $result = $this->tasks_model->setTask($idTask, $this->input->post('nameTask'), $this->input->post('descriptionTask'), $idUS, $this->input->post('costTask'),
                $this->tasks_model->getTaskId($this->input->post('TaskDependName')));
            if ($result == false)
                echo "La modification de la tâche n'est pas possible.";
        } else
            echo "La modification a échoué, veuillez vérifiez le contenu des champs.";

        $this->init($idPro, $idSprint);
    }


    public function deleteTask($idPro, $idSprint, $idTask)
    {
        $this->load->model("tasks_model");
        $result = $this->tasks_model->deleteTask($idTask);

        if ($result == false)
            echo "Impossible de supprimer l'US";

        $this->init($idPro, $idSprint);
    }


    private function getTasksList($idPro, $idSprint)
    {
        $this->load->model("tasks_model");
        $us_list = $this->tasks_model->getUserStories($idPro, $idSprint)->result_array();

        $tasks_list = array();
        foreach ($us_list as $row) {
            $tasks = $this->tasks_model->getTasks($row['idUS'])->result_array();
            foreach ($tasks as $task) {
                $infoTask = $this->tasks_model->getTask($task['idTask']);
                array_push($tasks_list, $infoTask);
            }
        }

        return $tasks_list;
    }

    private function getTasksDependIdName($tasks_list)
    {

        $taskDependIdName = array();
        $taskDependIdName[0] = null;
        foreach ($tasks_list as $row) {
            $taskDependName = $this->tasks_model->getTaskName($row['idTask']);
            $taskDependIdName[$row['idTask']] = $taskDependName->result_array()[0]['nameTask'];
        }
        return $taskDependIdName;
    }
}