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

    public function showSchedule(){
        $day=$_GET['day'] ??  date('l');
        $day=strtolower($day);
        $period=$_GET['period'] ?? 1;

        $occupiedRooms=$this->scheduleTable->findOccupiedRooms($day,$period,'roomNo');
        $occupiedRooms=array_merge($occupiedRooms,$this->approvalTable->findOccupiedRooms($day,$period,'roomNo'));
        $rooms['211']=false;
        $rooms['212']=false;
        $rooms['213']=false;
        $rooms['214']=false;
        $rooms['215']=false;
        $rooms['216']=false;
        for($building=2;$building<=3;$building++){
            for($floor=1;$floor<=3;$floor++){
                for($room=1;$room<=6;$room++){
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