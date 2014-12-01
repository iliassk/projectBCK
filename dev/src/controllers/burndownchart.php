<?php


class BurnDownChart extends CI_Controller
{

    public function index($idPro, $idSprint){

        date_default_timezone_set('Europe/Bucharest');

        $this->load->model("burndownchart_model");
        $tests_infos = $this->burndownchart_model->getBdcInfos($idPro, $idSprint)->result_array();

        $gantt_infos = $this->burndownchart_model->getGanttTestsDate($idPro, $idSprint)->result_array();

        $sprint_dates = $this->burndownchart_model->getSprintDates($idPro, $idSprint)->result_array()[0];

        $tests_rcost = $this->getRealTestCost($tests_infos);

        $total_sprint_cost = $this->getTotalSprintCost($tests_infos);

        $coordinate_rdate = $this->getRealCoordinates($tests_infos, $tests_rcost, $sprint_dates, $total_sprint_cost);

        $coordinate_edate = $this->getEstimatedCoordinates($gantt_infos, $tests_rcost, $sprint_dates, $total_sprint_cost);


        $data['estimated_coordinates'] = $coordinate_edate;
        $data['real_coordinates'] = $coordinate_rdate;
        $data['idSprint'] = $idSprint;

        $this->load->view("burndownchart_view", $data);

    }

    /**
     * @param $tests_infos
     * returns an array
     */
    private function getRealTestCost($tests_infos)
    {
        /**
         * get array
         * idUS => 'costUS' => costUS,
         *          'tasks' => array(idTask);
         */
        $us_tests = array();
        foreach($tests_infos as $test_infos){
            if(!isset($us_tests[$test_infos['idUS']])){
                $us_tests[$test_infos['idUS']]['costUS'] = $test_infos['costUS'];

                $us_tests[$test_infos['idUS']]['tasks'] = array();
                array_push($us_tests[$test_infos['idUS']]['tasks'], $test_infos['idTask']);
            }
            else{
                array_push($us_tests[$test_infos['idUS']]['tasks'], $test_infos['idTask']);
            }
        }

        /**
         * get array
         * idTask => taskRealCost
         */
        $tests_rcost = array();
        foreach($us_tests as $row){
            $total_cost = $row['costUS'];
            $nb_tests = count($row['tasks']);
            $real_cost = $total_cost / $nb_tests;

            foreach($row['tasks'] as $idTest){
                $tests_rcost[$idTest] = $real_cost;
            }
        }

        return $tests_rcost;
    }

    /**
     * @param $tests_infos
     * @return int totalSprintCost
     */
    private function gettotalSprintCost($tests_infos){

        /**
         * get array
         * idUS => costUS,
         */
        $us_cost = array();
        foreach($tests_infos as $test_infos){
            if(!isset($us_cost[$test_infos['idUS']])){
                $us_cost[$test_infos['idUS']] = $test_infos['costUS'];
            }
        }

        $total_cost = 0;
        foreach ($us_cost as $cost) {
            $total_cost += $cost;
        }
        return $total_cost;
    }

    /**
     * @param $tests_infos
     * @param $tests_rcost
     *
     * returns array
     */
    private function getRealCoordinates($tests_infos, $tests_rcost, $sprint_dates, $total_sprint_cost)
    {

        /**
         * get array (
         * date => cost
         */
        $date_cost = array();
        foreach ($tests_infos as $test_infos) {
            if ($test_infos['exec_date'] != null) {
                if (!isset($date_cost[$test_infos['exec_date']])) {
                    $date_cost[$test_infos['exec_date']] =
                        $tests_rcost[$test_infos['idTask']];
                } else {
                    $date_cost[$test_infos['exec_date']] +=
                        $tests_rcost[$test_infos['idTask']];
                }
            }
        }
        ksort($date_cost, $sort_flags = SORT_REGULAR);

        return $this->getCoordinates($date_cost, $sprint_dates, $total_sprint_cost);
    }

    private function getEstimatedCoordinates($gantt_infos, $tests_rcost, $sprint_dates, $total_sprint_cost)
    {

        /**
         * get array (
         * date => cost
         */
        $date_cost = array();
        foreach ($gantt_infos as $test_infos) {
            if($test_infos['MAX(gantt.date)'] != null) {
                if (!isset($date_cost[$test_infos['MAX(gantt.date)']])) {
                    $date_cost[$test_infos['MAX(gantt.date)']] =
                        $tests_rcost[$test_infos['idTask']];
                } else {
                    $date_cost[$test_infos['MAX(gantt.date)']] +=
                        $tests_rcost[$test_infos['idTask']];
                }
            }
        }
        ksort($date_cost, $sort_flags = SORT_REGULAR);

        return $this->getCoordinates($date_cost, $sprint_dates, $total_sprint_cost);
    }



        /**
         * get array
         * date => remainingCost
         */
    private function getCoordinates($date_cost, $sprint_dates, $total_sprint_cost){
        $coordinates = array();
        $array_dates = $this->createDateRangeArray($sprint_dates['date_debut'],$sprint_dates['date_fin']);

        $coordinates[0]['date'] = '';
        $coordinates[0]['cost'] = $total_sprint_cost;
        $index = 1;
        foreach($array_dates as $date){
            $coordinates[$index]['date'] = $date;
            $coordinates[$index]['cost'] = $total_sprint_cost;
            $index++;
        }

        $remaining_cost = $total_sprint_cost;
        foreach($coordinates as &$coord){
            if (isset($date_cost[$coord['date']])) {
                $remaining_cost -= $date_cost[$coord['date']];
                $coord['cost'] = $remaining_cost;
            }
            else{
                $coord['cost'] = $remaining_cost;
            }
        }

        return $coordinates;
    }



    /**
     * @param $strDateFrom
     * @param $strDateTo
     * @return array
     *
     * source : http://boonedocks.net/mike/archives/137-Creating-a-Date-Range-Array-with-PHP.html
     */
    public function createDateRangeArray($strDateFrom,$strDateTo)
    {
        // takes two dates formatted as YYYY-MM-DD and creates an
        // inclusive array of the dates between the from and to dates.

        // could test validity of dates here but I'm already doing
        // that in the main script

        $aryRange=array();

        $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
        $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

        if ($iDateTo>=$iDateFrom)
        {
            array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
            while ($iDateFrom<$iDateTo)
            {
                $iDateFrom+=86400; // add 24 hours
                array_push($aryRange,date('Y-m-d',$iDateFrom));
            }
        }
        return $aryRange;
    }

}