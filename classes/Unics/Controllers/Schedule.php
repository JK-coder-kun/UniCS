<?php
namespace Unics\Controllers;
use Common\DatabaseTable;
class Schedule{
    private $scheduleTable;
    private $approvalTable;

    public function __construct(DatabaseTable $scheduleTable,DatabaseTable $approvalTable)
    {   
        $this->scheduleTable=$scheduleTable;
        $this->approvalTable=$approvalTable;
    }

    public function searchSchedule(){
        if (isset($_GET['filter'])) {
            $filter = $_GET['filter'];
            foreach ($filter as $key => $value) {
                if ($value == null || $value = '') {
                    unset($filter[$key]);
                }
            }
            if (empty($filter)) {
                $result = $this->scheduleTable->findAll();
            } else {
                $result = $this->scheduleTable->findMultiColumn($filter);
            }
        } else {
            $result = $this->scheduleTable->findAll();
        }
        $title = "Search Schedule";
        return [
            'template' => 'searchschedule.html.php',
            'title' => $title,
            'variables' => [
                'result' => $result,
                'filter' => $filter??[]
            ]
        ];
    }

    public function showSchedule(){
        $day=$_GET['day'] ??  date('l');
        $day=strtolower($day);
        $period=$_GET['period'] ?? 1;

        $occupiedRooms=$this->scheduleTable->findOccupiedRooms($day,$period,'roomNo');
        $occupiedRooms=array_merge($occupiedRooms,$this->approvalTable->findOccupiedRooms($day,$period,'roomNo'));
        // $rooms['211']=false;
        // $rooms['212']=false;
        // $rooms['216']=false;
        
        $rooms['213']=false;
        $rooms['214']=false;
        $rooms['215']=false;

        $rooms['244']=false;
        $rooms['245']=false;
        $rooms['352']=false;
        $rooms['353']=false;
        
        for($building=2;$building<=3;$building++){
            for($floor=2;$floor<=3;$floor++){
                for($room=1;$room<=6;$room++){
                    if($floor==2 && $building==2)continue;
                    $roomNo=$building.$floor.$room;
                    $rooms[$roomNo]=false;
                }
            }
        }
        foreach($rooms as $key=>$value){
            for($n=0;$n<count($occupiedRooms);$n++){
                if($occupiedRooms[$n]['roomNo']==$key){
                    $rooms[$key]=$occupiedRooms[$n];
                }
            }
        }
        //$schedules=$this->scheduleTable->findAll();
        $title='Schedule';
        return [
            'template'=>'showschedule.html.php',
            'title'=>$title,
            'variables'=>[
                'rooms'=>$rooms,
                'day'=>$day,
                'period'=>$period
                ]
        ];
    }
}