<?php
namespace Unics\Controllers;
use Ninja\DatabaseTable;
class Schedule{
    private $scheduleTable;

    public function __construct(DatabaseTable $scheduleTable)
    {   
        $this->scheduleTable=$scheduleTable;
    }

    public function showSchedule(){
        $day=$_GET['day'] ??  date('l');
        $day=strtolower($day);
        for($period=1;$period<=6;$period++){
            $schedules[$period]=$this->scheduleTable->findByTwoColumn('day',$day,'period',$period);
        }
        //$schedules=$this->scheduleTable->findAll();
        $title='Schedule';


        return [
            'template'=>'showschedule.html.php',
            'title'=>$title,
            'variables'=>[
                'schedules'=>$schedules,
                'day'=>$day
                ]
        ];
    }
}