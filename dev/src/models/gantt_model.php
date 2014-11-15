<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 14/11/14
 * Time: 14:19
 */

class Gantt_model extends CI_Model {

    public function getGantt($idPro, $idSprint) {
        $this->db->select('task.nameTask, task.idTask, gantt.idDev, developper.nameDev, gantt.date');
        $this->db->from('task');
        $this->db->join('gantt', 'task.idTask = gantt.idTask', 'left');
        $this->db->join('developper', 'gantt.idDev = developper.idDev', 'left');
        $this->db->where('task.idPro', $idPro);
        $this->db->where('task.idSprint', $idSprint);
        $this->db->order_by('gantt.idDev', 'ASC');
        $this->db->order_by('gantt.date', 'ASC');
        return $this->db->get();
    }

    public function getTasks($idPro, $idSprint) {
        return $this->db->query("SELECT task.nameTask, task.idTask, task.costTask FROM task
            WHERE task.idPro =". $idPro ." AND task.idSprint =". $idSprint);
    }

    public function addTask($idDev, $idTask, $date) {
        return $this->db->query("INSERT INTO gantt(idDev, date, idTask) VALUES (".$idDev.", '".$date."', ".$idTask.")");
    }

    public function removeTask($idDev, $idTask, $date) {
        return $this->db->query("DELETE FROM gantt WHERE idDev =".$idDev." and date ='".$date."' and idTask =".$idTask);
    }

} 