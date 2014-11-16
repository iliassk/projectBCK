<?php


class Tasks extends CI_Controller
{

    public function index($idPro, $idSprint)
    {
        $this->load->model("tasks_model");
        $tasksInfo = $this->tasks_model->getTasksInfo($idPro, $idSprint);

        $data['tasksInfo'] = $tasksInfo;
        $data['idPro'] = $idPro;
        $data['idSprint'] = $idSprint;

        $this->load->view('tasks_list_view', $data);

    }


    public function ValidateTask()
    {
        $this->load->library("form_validation");
        $this->load->model("tasks_model");


        $this->form_validation->set_rules('nameTask', "nom de la tâche", 'required');
        $this->form_validation->set_rules('descriptionTask', "description de la tâche", 'required');
        $this->form_validation->set_rules('costTask', "coût de la tâche", 'required|Integer');
        $this->form_validation->set_rules('nameUS', "US associée", '');
        // add constraint less_than for sprint when project_model implemented

        $this->form_validation->set_message('required', "Le champ \"%s\" est requis.");
        $this->form_validation->set_message('Integer', "Le champ \"%s\" doit contenir un entier.");

            return $this->form_validation->run();
        return false;
    }

    public function validTaskInformations($nbUsDepend, $nbTasksDepend){

        //verification US exist
        $validUS = true;

        for ($i=0; $i<$nbUsDepend; $i++) {

            $nameUsDepend = $this->input->post('nameUS');

            if ($nameUsDepend != '') {
                $idUsDepend = $this->tasks_model->getUsId($nameUsDepend)->result_array();

                if ($idUsDepend == array())
                    $validUS = false;
            }
        }
        //verification tasks exist
        $validTasks = true;

        for ($i=0; $i<$nbTasksDepend; $i++) {
            $nameTaskDepend = $this->input->post('taskDepend');


            if ($nameTaskDepend != '') {
                $idTaskDepend = $this->tasks_model->getTaskId($nameTaskDepend)->result_array();


                if ($idTaskDepend == array())
                    $validTasks = false;
            }
        }
        return ($validTasks && $validUS);
    }

    public function setTask($idPro, $idSprint, $idTask) //plus idUS
    {
        $this->load->model("tasks_model");
        if ($idTask == 0) {

            $data['url'] = 'tasks/addTask/' . $idPro . '/' . $idSprint;
            $data['taskInfo'] = array('idTask' => 0, 'idPro' => $idPro, 'idSprint' => $idSprint, 'nameTask' => null,
            'descriptionTask' => null, 'costTask' => null, 'is_test' => null, 'taskDepend' => array(),
            'usDepend' => array());
            $data['idPro'] = $idPro;
            $data['idSprint'] = $idSprint;
        } else {

            $taskInfo = $this->tasks_model->getTaskInfo($idTask);

            $data['url'] = 'tasks/updateTask/' . $idPro . '/' . $idSprint . '/' . $idTask;
            $data['taskInfo'] = $taskInfo;
            $data['idPro'] = $idPro;
            $data['idSprint'] = $idSprint;

        }
        $this->load->view("set_task_view", $data);
    }


    public function addTask($idPro, $idSprint)
    {
        $nbUsDepend = 1;
        $nbTasksDepend = 1;
        if ($this->validateTask($nbUsDepend, $nbTasksDepend)) {
            if ($this->validTaskInformations($nbUsDepend, $nbTasksDepend)) {
                $this->load->model("tasks_model");

                // mise en forme des entrée dans la bd
                $is_test = $this->input->post('is_test');
                if ($is_test == 'accept')
                    $is_test = 1;
                else
                    $is_test = 0;


                $taskDepend = array();
                for ($i = 0; $i < $nbTasksDepend; $i++) {

                    $nameTaskDepend = $this->input->post('taskDepend');
                    if ($nameTaskDepend != '')
                        $idTaskDepend = $this->tasks_model->getTaskId($nameTaskDepend)->result_array()[0];
                    else
                        $idTaskDepend['idTask'] = 0;

                    $taskDependInfo['idDepend'] = $idTaskDepend['idTask'];
                    $taskDependInfo['nameTaskDepend'] = $nameTaskDepend;

                    array_push($taskDepend, $taskDependInfo);
                }


                $usDepend = array();
                for ($i = 0; $i < $nbUsDepend; $i++) {
                    $nameUsDepend = $this->input->post('nameUS');

                    if ($nameUsDepend != '')
                        $idUsDepend = $this->tasks_model->getUsId($nameUsDepend)->result_array()[0];
                    else
                        $idUsDepend['idUS'] = 0;

                    if ($idUsDepend == array())
                        $usDependInfo['idUS'] = 0;
                    else
                        $usDependInfo['idUS'] = $idUsDepend['idUS'];

                    $usDependInfo['nameUS'] = $nameUsDepend;

                    array_push($usDepend, $usDependInfo);
                }

                //ajout de la tache dans la bd
                $result = $this->tasks_model->addTask($this->input->post('nameTask'), $idPro, $idSprint,
                    $this->input->post('descriptionTask'), $usDepend, $this->input->post('costTask'),
                    $is_test, $taskDepend);
                if ($result == false)
                    echo "L'ajout dans la base de donnée n'est pas possible.";
            }
            else{
                echo "La tâche ou l'US spécifiée n'existe pas.";
            }
        }
        else
            echo "L'ajout a échoué, veuillez vérifiez le contenu des champs.";

        $this->index($idPro, $idSprint);
    }


    public function updateTask($idPro, $idSprint, $idTask)
    {
        $nbUsDepend = 1;
        $nbTasksDepend = 1;
        if ($this->validateTask($nbUsDepend, $nbTasksDepend)) {
            if ($this->validTaskInformations($nbUsDepend, $nbTasksDepend)) {
                $this->load->model("tasks_model");

                // mise en forme des entrée dans la bd
                $is_test = $this->input->post('is_test');
                if ($is_test == 'accept')
                    $is_test = 1;
                else
                    $is_test = 0;


                $taskDepend = array();
                for ($i = 0; $i < $nbTasksDepend; $i++) {

                    $nameTaskDepend = $this->input->post('taskDepend');
                    if ($nameTaskDepend != '')
                        $idTaskDepend = $this->tasks_model->getTaskId($nameTaskDepend)->result_array()[0];
                    else
                        $idTaskDepend['idTask'] = 0;

                    $taskDependInfo['idDepend'] = $idTaskDepend['idTask'];
                    $taskDependInfo['nameTaskDepend'] = $nameTaskDepend;

                    array_push($taskDepend, $taskDependInfo);
                }


                $usDepend = array();
                for ($i = 0; $i < $nbUsDepend; $i++) {
                    $nameUsDepend = $this->input->post('nameUS');

                    if ($nameUsDepend != '')
                        $idUsDepend = $this->tasks_model->getUsId($nameUsDepend)->result_array()[0];
                    else
                        $idUsDepend['idUS'] = 0;

                    if ($idUsDepend == array())
                        $usDependInfo['idUS'] = 0;
                    else
                        $usDependInfo['idUS'] = $idUsDepend['idUS'];

                    $usDependInfo['nameUS'] = $nameUsDepend;

                    array_push($usDepend, $usDependInfo);
                }


                //modifiaction de la tache dans la bd
                $result = $this->tasks_model->setTask($idTask, $this->input->post('nameTask'),
                    $this->input->post('descriptionTask'), $this->input->post('costTask'),
                    $taskDepend, $usDepend, $is_test);
                if ($result == false)
                    echo "La modification de la tâche n'est pas possible.";
            } else {
                echo "La tâche ou l'US spécifiée n'existe pas.";
            }
        }
        else{
                echo "La modification a échoué, veuillez vérifiez le contenu des champs.";
            }
        $this->index($idPro, $idSprint);
        }


    public function deleteTask($idPro, $idSprint, $idTask)
    {
        $this->load->model("tasks_model");
        $result = $this->tasks_model->deleteTask($idTask);

        if ($result == false)
            echo "Impossible de supprimer la tâche";

        $this->index($idPro, $idSprint);
    }


}