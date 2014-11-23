<?php

//[Mtest]

class Tests_model extends CI_model
{

    public function getTests($idPro, $idSprint){

        $this->db->select('*');
        $this->db->from('test');
        $this->db->join('task', 'test.idTask = task.idTask');
        $this->db->where('task.idPro', $idPro);
        $this->db->where('task.idSprint', $idSprint);

        $queryTests = $this->db->get();

        return $queryTests;
    }


    public function getTestInfos($idTask){

        $this->db->select('task.nameTask, task.descriptionTask, test.idDev, developper.nameDev, test.exec_date, test.result');
        $this->db->from('test');
        $this->db->join('task', 'task.idTask = test.idTask', 'left');
        $this->db->join('developper', 'test.idDev = developper.idDev', 'left');
        $this->db->where('test.idTask', $idTask);
        return $this->db->get();

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



    public function updateTest($idTask, $idDev, $exec_date, $result){
        return $this->db->query("UPDATE test SET idDev = ". $idDev .", exec_date = '". $exec_date ."', result =". $result
            ." WHERE idTask = ". $idTask);
    }


}

//[end Mtest]