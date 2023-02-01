<?php 
namespace Unics\Controllers;
use \Common\DatabaseTable;
use DateTime;
use Exception;
use \Unics\Entity\Request;
class RequestOperator{
    public $request;
    private $scheduleTable;
    private $approvalTable;
    private $notificationTable;
    private $priorityTable;
    private $requestTable;
    private $userTable;
    public function __construct(DatabaseTable $scheduleTable,
                        DatabaseTable $approvalTable,
                        DatabaseTable $requestTable,
                        DatabaseTable $notificationTable,
                        Request $request=null)
    {
        if($request!=null)$this->request=$request;
        $this->scheduleTable=$scheduleTable;
        $this->approvalTable=$approvalTable;
        $this->requestTable=$requestTable;
        $this->notificationTable=$notificationTable;
        $pdo=$this->notificationTable->getDatabase();
        $this->priorityTable=new \Common\DatabaseTable($pdo,'priority','priority');
        $this->userTable=new \Common\DatabaseTable($pdo,'user','id','\Unics\Entity\User');

    }

    public function checkRequestedDay(){
        //check if requested day is today or not
        if($this->request->day == strtolower(date('l'))){
            return $this->checkTodayRequest();
        }else{
            
            return true;
        }
    }
    public function checkTodayRequest(){
        date_default_timezone_set('Asia/Yangon');
        echo date('h:i');
        switch(true){
            case(time() < strtotime("08:30:00")):
                $currentPeriod=0;break;
            case(time() < strtotime("09:40:00")):
                $currentPeriod=1;break;
            case(time() < strtotime("10:50:00")):
                $currentPeriod=2;break;
            case(time() < strtotime("13:40:00")):
                $currentPeriod=3;break;
            case(time() < strtotime("14:50:00")):
                $currentPeriod=4;break;
            case(time() < strtotime("15:00:00")):
                $currentPeriod=5;break;
            default: $currentPeriod=6;break;
        }
        if($this->request->period < $currentPeriod){
            return false;
        }
        $this->approveRequest();
        $this->sendApproval();
        return true;
    }
    public function checkFree(){
        $approvals=$this->approvalTable->findByThreeColumn('period',
                                            $this->request->period,'day',
                                            $this->request->day,'roomNo',$this->request->roomNo);
        $schedules=$this->scheduleTable->findByThreeColumn('period',
                                            $this->request->period,'day',
                                            $this->request->day,'roomNo',$this->request->roomNo);
        return (empty($approvals) && empty($schedules));
    }
    public function approveRequest(){
        $requestArray=['roomNo'=>$this->request->roomNo,
                        'day'=>$this->request->day,
                        'period'=>$this->request->period,
                        'reason'=>$this->request->reason,
                        'userId'=>$this->request->userId];
        try{
            $this->approvalTable->save($requestArray);
        }catch(Exception $e){
            echo $e;
        }
       
    }
    
    public function sendApproval(){
        $notiText="Your request has been approved!\nRoom No:".$this->request->roomNo
                ."\nTime :".$this->request->day.", ".$this->request->period;
        $notiInfo=['userId'=>$this->request->userId,'status'=>1,'time'=>new DateTime(),
                    'notiText'=>$notiText];
        $this->notificationTable->save($notiInfo);
    }

    public function compareRequests($requests){
        $priorityObjs=$this->priorityTable->findAll('priority');
        foreach($priorityObjs as $priorityObj){
            $priority[$priorityObj->reason]=$priorityObj->priority;
        }
        //$highestPriority=sizeof($priority);
        $chosenReq=$requests[0];
        foreach($requests as $request){
            $user=$this->userTable->findById($request->userId);
            if($user->role=='par choke'){
                return $request;
            }else if($priority[$request->reason]==sizeof($priority)){
                return $request;
            }else if($priority[$request->reason]>$priority[$chosenReq->reason]){
                $chosenReq=$request;
            }
        }
        return $chosenReq;
    }
}