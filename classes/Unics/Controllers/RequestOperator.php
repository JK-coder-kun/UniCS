<?php 
namespace Unics\Controllers;
use \Common\DatabaseTable;
use \Unics\Entity\Request;
class RequestOperator{
    public $request;
    private $scheduleTable;
    private $approvalTable;
    private $requestTable;
    public function __construct(Request $request,DatabaseTable $scheduleTable,DatabaseTable $approvalTable,DatabaseTable $requestTable)
    {
        $this->request=$request;
        $this->scheduleTable=$scheduleTable;
        $this->approvalTable=$approvalTable;
        $this->requestTable=$requestTable;
        echo "in request operator";
        print_r($request);
    }

    public function checkRequestedDay(){
        //check if requested day is today or not
        if($this->request->day == strtolower(date('l'))){
            echo "the same day";
            return $this->checkTodayRequest();
        }else{
            echo "the other day";
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
}