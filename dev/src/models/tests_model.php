<?php

//[Mtest]

class Tests_model extends CI_model
{
    public function getTest($idTask){
        $this->db->select('idTask', 'idDev', 'exec_date', 'result');
        $this->db->from('test');
        $this->db->where('idTask', $idTask);

        $queryTest = $this->db->get();
        return $queryTest;
    }

    public function getTests($idPro, $idSprint){

        $this->db->select('*');
        $this->db->from('test');
        $this->db->join('task', 'test.idTask = task.idTask');
        $this->db->where('task.idPro', $idPro);
        $this->db->where('task.idSprint', $idSprint);

        $queryTests = $this->db->get();

        return $queryTests;
    }

    /*
    * return :
    * taskIdName -> [idTask, nameTask]
    * respDevIdName -> [idDev, nameDev]
    * descriptionTask
    * exec_date
    * result
    */
    public function getTestInfos($idTask){

        $testInfos = array();
        $testTableInfos = $this->getTest($idTask)->result_array()[0];

        $testInfos['taskIdName'] =
            $this->getTestIdName($testTableInfos['idTask'])->result_array()[0];
        $testInfos['respDevIdName'] =
            $this->getDevIdName($testTableInfos['idDev'])->result_array()[0];
        $testInfos['descriptionTask'] =
            $this->getDescriptionTask($testTableInfos['idTask']);
        $testInfos['exec_date]'] = $testTableInfos['exec_date'];
        $testInfos['result'] = $testTableInfos['result'];

        return $testInfos;


}

    /*
     * return table of:
     * taskIdName -> [idTask, nameTask]
     * respDevIdName -> [idDev, nameDev]
     * descriptionTask
     * exec_date
     * result
     */
    public function getTestsInfos($idPro, $idSprint){

        $testsInfos = array();
        $testsTableInfos = $this->getTests($idPro, $idSprint)->result_array();

        foreach($testsTableInfos as $row){
            if ($row['idDev'] == 0) {
                $respDevIdName = array(
                    'idDev' => $row['idDev'],
                    'nameDev' => '-'
                );
            }
            else
                $respDevIdName = $this->getDevIdName($row['idDev'])->result_array()[0];

            $testInfos['taskIdName'] = $this->getTaskIdName($row['idTask'])->result_array()[0];
            $testInfos['respDevIdName'] = $respDevIdName;
            $testInfos['descriptionTask'] = $row['descriptionTask'];
            $testInfos['exec_date'] = $row['exec_date'];
            $testInfos['result'] = $row['result'];

            array_push($testsInfos, $testInfos);
        }
        return $testsInfos;
    }


    public function getDevIdName($idDev){
        $this->db->select('idDev, nameDev');
        $this->db->from('developper');
        $this->db->where('idDev', $idDev);

        $queryDevIdName = $this->db->get();

        return $queryDevIdName;
    }

    public function getTaskIdName($idTask){
        $this->db->select('idTask, nameTask');
        $this->db->from('task');
        $this->db->where('idTask', $idTask);

        $queryTaskIdName = $this->db->get();
        return $queryTaskIdName;
    }

    public function getDescriptionTask($idTask){
        $this->db->select('descriptionTask');
        $this->db->from('task');
        $this->db->where('idTask', $idTask);

        $queryDescriptionTask = $this->db->get();

        return $queryDescriptionTask;
    }

    public function updateTest($idTask,$nameTask, $idDev, $exec_date, $result, $descriptionTask){

        $this->db->trans_start();

        // mise à jour de la table test
        $dataTest = array(
            'idDev' => $idDev,
            'exec_date' => $exec_date,
            'result' => $result
        );

        $this->db->where('idTask', $idTask);
        $this->db->update('test', $dataTest);

        //mise à jour de la table task
        $dataTask = array(
            'nameTask' => $nameTask,
            'descriptionTask' => $descriptionTask
        );

        $this->db->where('idTask', $idTask);
        $this->db->update('task', $dataTask);

        $this->db->trans_complete();
    }


}

//[end Mtest]