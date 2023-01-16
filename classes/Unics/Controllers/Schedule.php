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
        $schedules=$this->scheduleTable->findAll();
        echo "showSchedule function";
        echo $schedules[0]->day;
        $title='Schedule';

        return [
            'template'=>'showschedule.html.php',
            'title'=>$title,
            'variables'=>['schedules'=>$schedules]
        ];
    }
}