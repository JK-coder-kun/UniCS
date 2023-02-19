<?php
namespace Unics\Controllers;
use \Common\DatabaseTable;
use \Common\Authentication;
use DateTime;

class Request{
    private $scheduleTable;
    private $requestTable;
    private $approvalTable;
    private $authentication;
    private $requestOperator;
    private $notificationTable;
    private $priorityTable;
    private $request;

    public function __construct(DatabaseTable $scheduleTable,
                                DatabaseTable $requestTable,
                                DatabaseTable $approvalTable,
                                Authentication $authentication,
                                DatabaseTable $priorityTable,
                                DatabaseTable $notificationTable)
    {
        $this->scheduleTable=$scheduleTable;
        $this->requestTable=$requestTable;
        $this->approvalTable=$approvalTable;
        $this->authentication=$authentication;
        $this->priorityTable=$priorityTable;
        $this->notificationTable=$notificationTable;
    }

    public function showRoomSchedule(){
        if(isset($_GET['roomNo'])){
            $roomNo=$_GET['roomNo'];
            $roomSchedules['monday']=$this->scheduleTable->findRoomSchedule($roomNo,'monday','schedule');//return arrays
                    $roomSchedules['tuesday']=$this->scheduleTable->findRoomSchedule($roomNo,'tuesday','schedule');
                    $roomSchedules['wednesday']=$this->scheduleTable->findRoomSchedule($roomNo,'wednesday','schedule');
                    $roomSchedules['thursday']=$this->scheduleTable->findRoomSchedule($roomNo,'thursday','schedule');
                    $roomSchedules['friday']=$this->scheduleTable->findRoomSchedule($roomNo,'friday','schedule');
                    $roomSchedules['monday']=array_merge($roomSchedules['monday'], $this->approvalTable->findRoomSchedule($roomNo,'monday','schedule'));
                    $roomSchedules['tuesday']=array_merge($roomSchedules['tuesday'], $this->approvalTable->findRoomSchedule($roomNo,'tuesday','schedule'));
                    $roomSchedules['wednesday']=array_merge($roomSchedules['wednesday'], $this->approvalTable->findRoomSchedule($roomNo,'wednesday','schedule'));
                    $roomSchedules['thursday']=array_merge($roomSchedules['thursday'], $this->approvalTable->findRoomSchedule($roomNo,'thursday','schedule'));
                    $roomSchedules['friday']=array_merge($roomSchedules['friday'], $this->approvalTable->findRoomSchedule($roomNo,'friday','schedule'));
                    $priority=$this->priorityTable->findAll('priority DESC');
            $user=$this->authentication->getUser();
            $title='Request Room';
            return [
                'template'=>'requestRoom.html.php',
                'title'=>$title,
                'variables'=>[
                    'roomSchedules'=>$roomSchedules,
                    'roomNo'=>$roomNo,
                    'priority'=>$priority,
                    'user'=>$user,
                    'period'=>$_GET['period']??null,
                    'day'=>$_GET['day']??null
                ]
            ];
        }else{
            header('Location:schedule');
        }
    }
    public function sendRequest(){
        $requestForm=$_POST['request'];
        $user=$this->authentication->getUser();
        $requestForm['userId']=$user->id;
        $this->request=new \Unics\Entity\Request($requestForm);
        $requestOperator=new \Unics\Controllers\RequestOperator($this->scheduleTable,
                                                                $this->approvalTable,
                                                                $this->requestTable,
                                                                $this->notificationTable,
                                                                $this->request);

        // $schedules=$this->approvalTable->findByThreeColumn('period',$requestForm['period'],'day',$requestForm['day'],'roomNo',$requestForm['roomNo']);
        // $approvals=$this->scheduleTable->findByThreeColumn('period',$requestForm['period'],'day',$requestForm['day'],'roomNo',$requestForm['roomNo']);
        if($requestOperator->checkFree($this->request)){
            if($requestOperator->isToday()){
                if($requestOperator->checkTodayRequest()){
                    header('Location: schedule');
                }else{
                    $roomNo=$requestForm['roomNo'];
                    $roomSchedules['monday']=$this->scheduleTable->findRoomSchedule($roomNo,'monday','schedule');//return arrays
                    $roomSchedules['tuesday']=$this->scheduleTable->findRoomSchedule($roomNo,'tuesday','schedule');
                    $roomSchedules['wednesday']=$this->scheduleTable->findRoomSchedule($roomNo,'wednesday','schedule');
                    $roomSchedules['thursday']=$this->scheduleTable->findRoomSchedule($roomNo,'thursday','schedule');
                    $roomSchedules['friday']=$this->scheduleTable->findRoomSchedule($roomNo,'friday','schedule');
                    $roomSchedules['monday']=array_merge($roomSchedules['monday'], $this->approvalTable->findRoomSchedule($roomNo,'monday','schedule'));
                    $roomSchedules['tuesday']=array_merge($roomSchedules['tuesday'], $this->approvalTable->findRoomSchedule($roomNo,'tuesday','schedule'));
                    $roomSchedules['wednesday']=array_merge($roomSchedules['wednesday'], $this->approvalTable->findRoomSchedule($roomNo,'wednesday','schedule'));
                    $roomSchedules['thursday']=array_merge($roomSchedules['thursday'], $this->approvalTable->findRoomSchedule($roomNo,'thursday','schedule'));
                    $roomSchedules['friday']=array_merge($roomSchedules['friday'], $this->approvalTable->findRoomSchedule($roomNo,'friday','schedule'));
                    $priority=$this->priorityTable->findAll('priority DESC');
                    $title='Request Room';
                    $error="You can't request for today's previous period!";
                    return [
                        'template'=>'requestRoom.html.php',
                        'title'=>$title,
                        'variables'=>[
                            'roomSchedules'=>$roomSchedules,
                            'roomNo'=>$roomNo,
                            'priority'=>$priority,
                            'error'=>$error,
                            'user'=>$user
                        ]
                    ];
                }
            }else{
                date_default_timezone_set('Asia/Yangon');
                $date=new DateTime();
                $userid=$this->authentication->getUser()->id;
                $this->request=$this->requestTable->save(['period'=>$requestForm['period'],
                        'day'=>$requestForm['day'],'roomNo'=>$requestForm['roomNo'],
                        'date'=>$date,'reason'=>$requestForm['reason'],
                        'userId'=>$userid]); 
                $notiText='Your request have been sent!</br>RoomNo:'.$requestForm['roomNo'].', '.$requestForm['day'].', period'.$requestForm['period'].'</br>Tomorrow, you will receive checking result';
                $this->notificationTable->save([
                    'notiText'=>$notiText,
                    'time'=>$date,'userid'=>$userid,'status'=>1
                ]);
                header('Location: schedule');   
            }

      }else{
            $roomNo=$requestForm['roomNo'];
            $roomSchedules['monday']=$this->scheduleTable->findRoomSchedule($roomNo,'monday','schedule');//return arrays
                    $roomSchedules['tuesday']=$this->scheduleTable->findRoomSchedule($roomNo,'tuesday','schedule');
                    $roomSchedules['wednesday']=$this->scheduleTable->findRoomSchedule($roomNo,'wednesday','schedule');
                    $roomSchedules['thursday']=$this->scheduleTable->findRoomSchedule($roomNo,'thursday','schedule');
                    $roomSchedules['friday']=$this->scheduleTable->findRoomSchedule($roomNo,'friday','schedule');
                    $roomSchedules['monday']=array_merge($roomSchedules['monday'], $this->approvalTable->findRoomSchedule($roomNo,'monday','schedule'));
                    $roomSchedules['tuesday']=array_merge($roomSchedules['tuesday'], $this->approvalTable->findRoomSchedule($roomNo,'tuesday','schedule'));
                    $roomSchedules['wednesday']=array_merge($roomSchedules['wednesday'], $this->approvalTable->findRoomSchedule($roomNo,'wednesday','schedule'));
                    $roomSchedules['thursday']=array_merge($roomSchedules['thursday'], $this->approvalTable->findRoomSchedule($roomNo,'thursday','schedule'));
                    $roomSchedules['friday']=array_merge($roomSchedules['friday'], $this->approvalTable->findRoomSchedule($roomNo,'friday','schedule'));
                    $priority=$this->priorityTable->findAll('priority DESC');
            $title='Request Room';
            $error="Your requested schedule is not free";
            return [
                'template'=>'requestRoom.html.php',
                'title'=>$title,
                'variables'=>[
                    'roomSchedules'=>$roomSchedules,
                    'priority'=>$priority,
                    'roomNo'=>$roomNo,
                    'user'=>$user,
                    'error'=>$error
                ]
            ];
           
        }
        
    }
}