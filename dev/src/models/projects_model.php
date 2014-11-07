<?php

// [Mpro]

class Projects_model extends CI_Model
{

    public function getDevProjects($idDev)
    {
        $idDev = (int) $idDev;

        $this->db->select('idPro');
        $this->db->from('dev_project');
        $this->db->where('idDev', $idDev);

        $queryId =  $this->db->get();

        $this->db->select('namePro');
        $this->db->from('project');
        $this->db->join('dev_project', 'project.idPro = dev_project.idPro');
        $this->db->where('dev_project.idDev', $idDev);

        $queryName = $this->db->get();


        $res_array = array();
        $nbPro = 0;
        foreach ($queryId->result_array() as $table)
        {
            $res_array[$nbPro] =
                array(
                    "idPro" => $table['idPro'],
                    "namePro" => $queryName->result_array()[$nbPro]['namePro']);
            $nbPro++;
        }
        return $res_array;
    }


    public function createProject($idDev, $namePro)
    {

        $idDev = (int)$idDev;
        $namePro = (string)$namePro;

        try {
            $this->db->trans_start();

            //recuperation de l'id du nouveau projet

            $req = $this->db->query("SHOW TABLE STATUS LIKE 'project'");

            $nextProjectId =$req->result_array()[0]['Auto_increment'];

            //Ajout dans la table dev_project
            $req = $this->db->query("INSERT INTO dev_project (idDev, idPro, admin)
            VALUES ($idDev, $nextProjectId, 1)");
            //$req->execute();

            //Ajout dans la table projet
            $req = $this->db->query("INSERT INTO project (namePro)
            VALUES ('$namePro')");
            //$req->execute();

            $this->db->trans_complete();
        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Erreur SQL : " . $e->getMessage();
            return false;
        }

        return true;
    }

    public function removeProject($idPro)
    {
        print_r('o');
        $idPro = (int)$idPro;

        //retirer le le projet de la table project et toutes ses occurrences dans dev_project

        try {
            $this->db->query("DELETE FROM project WHERE idPro = $idPro");
            $this->db->query("DELETE FROM dev_project WHERE (idPro = $idPro)");

        } catch (Exception $e) {
            echo "Erreur SQL : " . $e->getMessage();
            return false;
        }
        return true;
    }

    public function removeProjectFromDeveloper($idDev, $idPro)
    {
        $idDev = (int)$idDev;
        $idPro = (int)$idPro;

        try {
            $req = $this->db->query("DELETE FROM dev_project WHERE (idDev = $idDev) && (idPro = $idPro)");
            //$req->execute();
        } catch (Exception $e) {
            echo "Erreur SQL : " . $e->getMessage();
            return false;
        }
        return true;
    }



}

//[end Mpro]