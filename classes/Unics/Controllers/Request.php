<?php
namespace Unics\Controllers;
use \Common\DatabaseTable;
use \Common\Authentication;
class Request{
    private $scheduleTable;
    private $requestTable;
    private $approvalTable;
    private $authentication;
    private $requestOperator;
    private $notificationTable;
    private $request;

    public function __construct(DatabaseTable $scheduleTable,
                                DatabaseTable $requestTable,
                                DatabaseTable $approvalTable,
                                Authentication $authentication,
                                DatabaseTable $notificationTable)
    {
        $this->scheduleTable=$scheduleTable;
        $this->requestTable=$requestTable;
        $this->approvalTable=$approvalTable;
        $this->authentication=$authentication;
        $this->notificationTable=$notificationTable;
    }

    public function showRoomSchedule(){
        if(isset($_GET['roomNo'])){
            $roomNo=$_GET['roomNo'];
            $roomSchedules['monday']=$this->scheduleTable->findRoomSchedule($roomNo,'monday','schedule');//return arrays
            $roomSchedules['tuesday']=$this->scheduleTable->findRoomSchedule($roomNo,'tuesday','schedule');
            $roomSchedules['wednesday']=$this->scheduleTable->findRoomSchedule($roomNo,'webnesday','schedule');
            $roomSchedules['thursday']=$this->scheduleTable->findRoomSchedule($roomNo,'thursday','schedule');
            $roomSchedules['friday']=$this->scheduleTable->findRoomSchedule($roomNo,'friday','schedule');
            $roomSchedules['monday']=$this->approvalTable->findRoomSchedule($roomNo,'monday','schedule');
            $roomSchedules['tuesday']=$this->approvalTable->findRoomSchedule($roomNo,'tuesday','schedule');
            $roomSchedules['wednesday']=$this->approvalTable->findRoomSchedule($roomNo,'wednesday','schedule');
            $roomSchedules['thursday']=$this->approvalTable->findRoomSchedule($roomNo,'thursday','schedule');
            $roomSchedules['friday']=$this->approvalTable->findRoomSchedule($roomNo,'friday','schedule');
            $title='Request Room';
            return [
                'template'=>'requestRoom.html.php',
                'title'=>$title,
                'variables'=>[
                    'roomSchedules'=>$roomSchedules,
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
        $requestForm['userId']=$this->authentication->getUser()->id;
        $this->request=new \Unics\Entity\Request($requestForm);
        $requestOperator=new \Unics\Controllers\RequestOperator($this->scheduleTable,
                                                                $this->approvalTable,
                                                                $this->requestTable,
                                                                $this->notificationTable,
                                                                $this->request);

        // $schedules=$this->approvalTable->findByThreeColumn('period',$requestForm['period'],'day',$requestForm['day'],'roomNo',$requestForm['roomNo']);
        // $approvals=$this->scheduleTable->findByThreeColumn('period',$requestForm['period'],'day',$requestForm['day'],'roomNo',$requestForm['roomNo']);
        if($requestOperator->checkFree()){
            if($requestOperator->checkRequestedDay()){
                if(isset($requestForm['reason'])){
                    echo "enter to reason</br>";
                    $this->request=$this->requestTable->save(['period'=>$requestForm['period'],
                            'day'=>$requestForm['day'],'roomNo'=>$requestForm['roomNo'],
                            'reason'=>$requestForm['reason'],'userId'=>$this->authentication->getUser()->id]);
                }else{
                    $this->request=$this->requestTable->save(['period'=>$requestForm['period'],
                        'day'=>$requestForm['day'],'roomNo'=>$requestForm['roomNo'],
                        'section'=>$requestForm['section'],
                        'subjectCode'=>$requestForm['subjectCode'],'userId'=>$this->authentication->getUser()->id]);
                }  
                
                header('Location: schedule');   
            }

               
        }else{
            $roomNo=$requestForm['roomNo'];
            $roomSchedules['monday']=$this->scheduleTable->findRoomSchedule($roomNo,'monday','schedule');//return arrays
            $roomSchedules['tuesday']=$this->scheduleTable->findRoomSchedule($roomNo,'tuesday','schedule');
            $roomSchedules['wednesday']=$this->scheduleTable->findRoomSchedule($roomNo,'webnesday','schedule');
            $roomSchedules['thursday']=$this->scheduleTable->findRoomSchedule($roomNo,'thursday','schedule');
            $roomSchedules['friday']=$this->scheduleTable->findRoomSchedule($roomNo,'friday','schedule');
            $roomSchedules['monday']=$this->approvalTable->findRoomSchedule($roomNo,'monday','schedule');
            $roomSchedules['tuesday']=$this->approvalTable->findRoomSchedule($roomNo,'tuesday','schedule');
            $roomSchedules['wednesday']=$this->approvalTable->findRoomSchedule($roomNo,'wednesday','schedule');
            $roomSchedules['thursday']=$this->approvalTable->findRoomSchedule($roomNo,'thursday','schedule');
            $roomSchedules['friday']=$this->approvalTable->findRoomSchedule($roomNo,'friday','schedule');
            $title='Request Room';
            $error="Your requested schedule is not free";
            return [
                'template'=>'requestRoom.html.php',
                'title'=>$title,
                'variables'=>[
                    'roomSchedules'=>$roomSchedules,
                    'roomNo'=>$roomNo,
                    'error'=>$error
                ]
            ];
           
        }
        
    }
}