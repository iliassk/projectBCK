<?php

//[MTache]

class Tasks_model extends CI_model
{

    public function getUserStories($idPro, $idSprint)
    {
        return $this->db->query("SELECT idUS FROM userstory WHERE idPro =" . $idPro . " AND idSprint =" . $idSprint);
    }



    public function getTasks ($idUS) {
        return $this->db->query("SELECT idTask FROM task_us WHERE idUS=". $idUS );
    }

    public function getTaskName ($idTask) {
        return $this->db->query("SELECT nameTask FROM task WHERE idTask=". $idTask );
    }

    public function getTaskId ($nameTask) {
        if ($nameTask != null)
            return $this->db->query("SELECT idTask FROM task WHERE nameTask=". $nameTask );
        else
            return 0;
    }

    public function getTask($idTask)
    {

        //Recuperation des donnees dans les tables task, taskdepend et task_us

        $this->db->select('nameTask, descriptionTask, costTask, is_test');
        $this->db->from('task');
        $this->db->where('idTask', $idTask);

        $queryTask =  $this->db->get();

        $this->db->select('idDepend');
        $this->db->from('taskdepend');
        $this->db->where('idTask', $idTask);

        $queryTaskDepend = $this->db->get();

        $this->db->select('idUS');
        $this->db->from('task_us');
        $this->db->where('idTask', $idTask);

        $queryUS = $this->db->get();


        //Mise en forme du resultat

        $res_array = array();

        $queryTask = $queryTask->result_array()[0];
        $queryTaskDepend = $queryTaskDepend->result_array()[0];
        $queryUS = $queryUS->result_array()[0];

        $res_array['idTask'] = $idTask;
        $res_array['nameTask'] = $queryTask['nameTask'];
        $res_array['descriptionTask'] = $queryTask['descriptionTask'];
        $res_array['costTask'] = $queryTask['costTask'];
        $res_array['is_test'] = $queryTask['is_test'];

        $res_array['taskDepend'] = $queryTaskDepend['idDepend'];

        $res_array['idUS'] = $queryUS['idUS'];


        return $res_array;


    }

    public function addTask ($nameTask, $descriptionTask, $linkedUS, $costTask, $is_test, $idTaskDepend)
    {

        try{
            $this->db->trans_start();

            //Recuperation de l'id de la nouvelle tache a creer
            $req = $this->db->query("SHOW TABLE STATUS LIKE 'task'");
            $idTask =$req->result_array()[0]['Auto_increment'];

            //Ajout dans la table task
            $this->db->query("INSERT INTO task (nameTask, descriptionTask, costTask, is_test)
              VALUES (" ."'". $nameTask . "','" . $descriptionTask. "'," .$costTask . "," . $is_test . ")");

            //Ajout dans la table taskdepend

                $this->db->query("INSERT INTO taskdepend (idTask, idDepend)
                VALUES (" . $idTask . "," . $idTaskDepend . ")");

            //Ajout dans la table test (si is_test == true)

            if ($is_test){
                $this->db->query("INSERT INTO test (idTask, summary)
                VALUES (" .$idTask .")");
            }

            //Ajout dans la table task_us
            $this->db->query("INSERT INTO task_us (idTask, idUS)
              VALUES (" .$idTask. "," .$linkedUS .")");


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

    public function setTask ($idTask, $nameTask, $descriptionTask, $linkedUS, $costTask, $idtaskDepend)
    {

        try {
            $this->db->trans_start();

            //Modification dns les tables : task, taskdepend, et task_us

            $this->db->query("UPDATE task SET nameTask = '" . $nameTask . "', descriptionTask = '" . $descriptionTask . "', costTask =" . $costTask .
                " WHERE idTask = " . $idTask);
            $this->db->query("UPDATE taskdepend SET idDepend = " . $idtaskDepend .
                " WHERE idTask = " . $idTask);
            $this->db->query("UPDATE task_us SET idUS = " . $linkedUS .
                " WHERE idTask = " . $idTask);


        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Erreur SQL : " . $e->getMessage();
            return false;
        }
        return true;
    }


}


//[end MTache]