<?php


class BurnDownChart extends CI_Controller
{

    public function index($idPro, $idSprint){

        $this->load->model("burndownchart_model");
        $bdc_infos = $this->burndownchart_model->getBdcInfos($idPro, $idSprint);

        $data["bdc_infos"] = $bdc_infos;

        $bdc_coordinates = $this->associateDateCost($bdc_infos);

        print_r($bdc_infos->result_array()    );

       // $this->load->view("burndownchart_view", $data);

    }

    private function associateDateCost($bdc_infos){
        $bdc_coordinates = array();

        foreach($bdc_infos as $row){
            $coordinate = array(
                "date" => $row["exec_date"]
                "cost"
            )

            array_push($bdc_coordinates, $coordinate);
        }
    }

}