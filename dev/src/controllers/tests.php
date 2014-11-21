<?php

//[Ctest_affich]

class Tests extends CI_Controller
{

    public function index($idPro, $idSprint)
    {
        $this->testsList($idPro, $idSprint);
    }

    public function testsList($idPro, $idSprint)
    {
        $this->load->model("tests_model");
        $testsInfos = $this->tests_model->getTestsInfos($idPro, $idSprint);

        $data['testsInfos'] = $testsInfos;
        $data['idPro'] = $idPro;
        $data['idSprint'] = $idSprint;

        $this->load->view('tests_list_view', $data);

    }
    //[end Ctest_affich]

    //[Ctest_modif]

    public function setTest($idTask){
        echo 'page de modification de test';

    }
    //[end Ctest_modif]
}

