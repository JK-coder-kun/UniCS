<?php
namespace Unics\Controllers;
use \Ninja\DatabaseTable;
class Request{
    private $scheduleTable;
    private $requestTable;
    private $approvalTable;

    public function __construct(DatabaseTable $scheduleTable,DatabaseTable $requestTable,DatabaseTable $approvalTable)
    {
        $this->scheduleTable=$scheduleTable;
        $this->requestTable=$requestTable;
        $this->approvalTable=$approvalTable;
    }

    public function showRoomSchedule(){
        if(isset($_GET['roomNo'])){
            $roomNo=$_GET['roomNo'];
            $roomSchedule=$this->scheduleTable->findRoomSchedule($roomNo,'schedule');
            $roomSchedule=$this->approvalTable->findRoomSchedule($roomNo,'schedule');
            $title='Request Room';
            return [
                'template'=>'requestRoom.html.php',
                'title'=>$title,
                'variables'=>[
                    'roomSchedule'=>$roomSchedule,
                    'roomNo'=>$roomNo,
                    'period'=>$_GET['period']??null,
                    'day'=>$_GET['day']??null
                ]
            ];
        }else{
            $title='Schedule';
            return [
                'template'=>'showSchedule.html.php',
                'title'=>$title
            ];
        }
    }
    public function sendRequest(){
        $requestForm=$_POST['request'];
        $schedule=$this->approvalTable->findByThreeColumn('period',$requestForm['period'],'day',$requestForm['day'],'roomNo',$requestForm['roomNo']);
        $schedule=$this->scheduleTable->findByThreeColumn('period',$requestForm['period'],'day',$requestForm['day'],'roomNo',$requestForm['roomNo']);
        if(empty($schedule)){
            if(isset($_POST['reason'])){
            $approval=$this->approvalTable->save(['period'=>$requestForm['period'],
                    'day'=>$requestForm['day'],'roomNo'=>$requestForm['roomNo'],
                    'reason'=>$requestForm['reason']]);
            }else{
                $approval=$this->approvalTable->save(['period'=>$requestForm['period'],
                    'day'=>$requestForm['day'],'roomNo'=>$requestForm['roomNo'],
                    'section'=>$requestForm['section'],
                    'subjectCode'=>$requestForm['subjectCode']]);
            }        
        }
        header('Location: schedule');
        
    }
}