<?php
namespace Unics\Controllers;
use Ninja\DatabaseTable;
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
        for($period=1;$period<=6;$period++){
            $schedules[$period]=$this->scheduleTable->findByTwoColumn('day',$day,'period',$period,'roomNo');
            $approval[$period]=$this->approvalTable->findByTwoColumn('day',$day,'period',$period,'roomNo');
        }
        //$schedules=$this->scheduleTable->findAll();
        $title='Schedule';


        return [
            'template'=>'showschedule.html.php',
            'title'=>$title,
            'variables'=>[
                'schedules'=>$schedules,
                'approval'=>$approval,
                'day'=>$day
                ]
        ];
    }
}