<?php

//[MTache]

class Tasks_model extends CI_model
{

    public function getUserStories($idPro, $idSprint)
    {
        return $this->db->query("SELECT idUS FROM userstory WHERE idPro =" . $idPro . " AND idSprint =" . $idSprint);
    }

    public function getTasks ($idPro, $idSprint) {
        return $this->db->query("
                        SELECT idTask, idPro, `order`, idSprint, nameTask, descriptionTask, costTask, is_test, typeOfTask
                        FROM task
                        WHERE idPro=". $idPro ." AND idSprint=". $idSprint." order by `order` asc");
    }

    public function getTasksByType ($idPro, $idSprint, $typeOfTask) {
        /*$query = "SELECT idTask, idPro, `order`, idSprint, nameTask, descriptionTask, costTask, is_test, typeOfTask
                        FROM task
                        WHERE idPro= ? AND idSprint= ? AND typeOfTask = ? order by `order` asc";
        $result = $this->db->query($query, array($idPro, $idSprint, $typeOfTask));*/
        $query = "SELECT task.idTask, gantt.idTask, idPro, `order`, idSprint, nameTask, descriptionTask, costTask, is_test, typeOfTask,               idDev
                        FROM task
                        INNER JOIN gantt
                        ON task.idTask = gantt.idTask
                        WHERE idPro= ? AND idSprint= ? AND typeOfTask = ? order by `order` asc";
        $result = $this->db->query($query, array($idPro, $idSprint, $typeOfTask));
        return $result;
    }


    public function updateTaskOrder($tasks){
        foreach($tasks as $row){
            $cardId = explode("-", $row->cardId);
            $typeOfTask = $cardId[2];
            $order = 0;

            foreach($row->tasks as $taskId){
                $query = "update task set `order` = ?, typeOfTask = ? where idTask = ?";
                $this->db->query($query, array($order, $typeOfTask, $taskId));
                $order++;
            }
        }
    }

    public function getDescription ($taskId) {
        $query = "SELECT idTask, descriptionTask
                        FROM task
                        WHERE idTask = ?";
        $result = $this->db->query($query, array($taskId));
        return $result->row(0)->descriptionTask;
    }

    public function getTaskName ($idTask) {
        return $this->db->query("SELECT nameTask FROM task WHERE idTask=". $idTask );
    }

    public function getUsName ($idUS) {
        return $this->db->query("SELECT nameUS FROM userstory WHERE idUS=". $idUS );
    }

    public function getTaskId ($nameTask) {

        if ($nameTask != null && $nameTask != '')
            return $this->db->query("SELECT idTask FROM task WHERE nameTask='". $nameTask ."'" );
        else
            return 0;
    }

    public function getUsId ($nameUS){

        if ($nameUS != null && $nameUS != '')
            return $this->db->query("SELECT idUS FROM userstory WHERE nameUS='". $nameUS ."'" );
        else
            return 0;
    }

    public function getTasksDependIdName($idTask){



            $reqDep = $this->db->query("
                            SELECT idDepend
                            FROM taskdepend
                            WHERE idTask =" .$idTask);
            $tasksDepend = $reqDep->result_array();

        $tasksDependIdName = array();
        foreach($tasksDepend as $row){
            if ($row['idDepend'] != null) {
                $row['nameTaskDepend'] = $this->getTaskName($row['idDepend'])->result_array()[0]['nameTask'];
                array_push($tasksDependIdName, $row);

            }
        }

        return $tasksDependIdName;
    }

    public function getTasksUsIdName($idTask){


            $reqRes = $this->db->query("
                            SELECT idUS
                            FROM task_us
                            WHERE idTask =" .$idTask);
            $tasksUs = $reqRes->result_array();

        $tasksUsIdName = array();
        foreach($tasksUs as $row) {
            if ($row['idUS'] != null) {
                $row['nameUS'] = $this->getUsName($row['idUS'])->result_array()[0]['nameUS'];
                array_push($tasksUsIdName, $row);

            }
        }

        return $tasksUsIdName;
    }

    public function getTaskInfo($idTask)
    {
        $taskInfo = array();
        $taskTableInfo = $this->getTask($idTask)->result_array()[0];


        $taskTableInfo['taskDepend'] = $this->getTasksDependIdName($taskTableInfo['idTask']);
        $taskTableInfo['usDepend'] = $this->getTasksUsIdName($taskTableInfo['idTask']);

        return $taskTableInfo;
;
    }

   public function getTasksInfo($idPro, $idSprint)
   {
       $tasksInfo = array();

       $taskTableInfo = $this->getTasks($idPro,$idSprint)->result_array();

       $idTasksList = array();
       foreach ($taskTableInfo as $row){
           array_push($idTasksList, $row['idTask']);
       }



       foreach ($taskTableInfo as $row){
           $row['tasksDepend'] =  $this->getTasksDependIdName($row['idTask']);
           $row['usDepend'] =  $this->getTasksUsIdName($row['idTask']);

           array_push($tasksInfo, $row);
       }

      return $tasksInfo;
   }

    public function getTask($idTask)
    {
        return $this->db->query("
                        SELECT idTask, idPro, idSprint, nameTask, descriptionTask, costTask, is_test
                        FROM task
                        WHERE idTask=". $idTask);
    }

    public function addTask ($nameTask, $idPro, $idSprint, $descriptionTask,
                             $usDepend, $costTask, $is_test, $tasksDepend)
    {

        try{
            $this->db->trans_start();

            //Recuperation de l'id de la nouvelle tache a creer
            $req = $this->db->query("SHOW TABLE STATUS LIKE 'task'");
            $idTask =$req->result_array()[0]['Auto_increment'];

            //Ajout dans la table task
            $this->db->query("INSERT INTO task (idPro, idSprint, nameTask, descriptionTask, costTask, is_test)
              VALUES (" . $idPro . "," . $idSprint . ",'" . $nameTask . "','" .
                        $descriptionTask. "'," .$costTask . "," . $is_test . ")");

            //Ajout dans la table taskdepend

            foreach ($tasksDepend as $taskDepend) {

                if ($taskDepend['idDepend'] !=0) {
                    $this->db->query("INSERT INTO taskdepend (idTask, idDepend)
                VALUES (" . $idTask . "," . $taskDepend['idDepend'] . ")");
                }
            }

            //Ajout dans la table test (si is_test == true)

            if ($is_test){
                $this->db->query("INSERT INTO test (idTask)
                VALUES (" .$idTask .")");
            }

            //Ajout dans la table task_us

            foreach($usDepend as $us) {
                if ($us['idUS'] != 0) {
                    $this->db->query("INSERT INTO task_us (idTask, idUS)
              VALUES (" . $idTask . "," . $us['idUS'] . ")");
                }
            }

            $this->db->trans_complete();
        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Erreur SQL : " . $e->getMessage();
            return false;
        }

        return true;
    }

    public function deleteTask($idTask){

        try {
            $this->db->trans_start();

            //Supression de la tache dans les tables : task, taskdepend, test et task_us

            $this->db->query("DELETE FROM task WHERE idTask = $idTask");
            $this->db->query("DELETE FROM taskdepend WHERE idTask = $idTask");
            $this->db->query("DELETE FROM test WHERE idTask = $idTask");
            $this->db->query("DELETE FROM task_us WHERE idTask = $idTask");

            $this->db->trans_complete();
        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Erreur SQL : " . $e->getMessage();
            return false;
        }
        return true;
    }

    public function setTask ($idTask, $nameTask, $descriptionTask, $costTask, $tasksDepend, $usDepend, $is_test)
    {

        try {
            $this->db->trans_start();

            //Modification dns les tables : task, taskdepend, et task_us et is_tes

            //task
            $this->db->query("UPDATE task SET nameTask='" . $nameTask .
                "', descriptionTask='" . $descriptionTask . "', costTask=" . $costTask .
                ", is_test=" . $is_test .
                " WHERE idTask=" . $idTask);


            // task depend
            $this->db->query("DELETE FROM taskdepend WHERE idTask = $idTask");
            foreach($tasksDepend as $taskDepend) {

                if ($taskDepend['idDepend'] != 0) {
                    $this->db->query("INSERT INTO taskdepend (idTask, idDepend)
                VALUES (" . $idTask . "," . $taskDepend['idDepend'] . ")");
                }
            }

            //task_us
            $this->db->query("DELETE FROM task_us WHERE idTask = $idTask");
            foreach($usDepend as $us) {
                if ($us['idUS'] != 0) {
                    $this->db->query("INSERT INTO task_us (idTask, idUS)
              VALUES (" . $idTask . "," . $us['idUS'] . ")");
                }
            }

            // is_test
            $this->db->query("DELETE FROM test WHERE idTask = $idTask");
            if ($is_test){
                $this->db->query("INSERT INTO test (idTask)
                VALUES (" .$idTask .")");
            }

            $this->db->trans_complete();
        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Erreur SQL : " . $e->getMessage();
            return false;
        }
        return true;
    }


}


//[end MTache]