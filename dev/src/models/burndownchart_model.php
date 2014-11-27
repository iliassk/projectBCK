<?php

//[Mtest]

class Burndownchart_model extends CI_model
{

    public function getBdcInfos($idPro, $idSprint)
    {

        $this->db->select('task.idTask, test.exec_date, test.result, task_us.idUS, userstory.costUS');
        $this->db->from('task');
        $this->db->join('test', 'task.idTask = test.idTask', 'left');
        $this->db->join('task_us', 'task.idTask = task_us.idTask', 'left');
        $this->db->join('userstory', 'task_us.idUS = userstory.idUS', 'left');
        $this->db->where('task.idPro', $idPro);
        $this->db->where('task.idSprint', $idSprint);

        return $this->db->get();

    }
}