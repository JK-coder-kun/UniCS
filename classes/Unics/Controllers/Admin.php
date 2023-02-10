<?php

namespace Unics\Controllers;

use \Common\DatabaseTable;
use Exception;

class Admin
{
    private $priorityTable;
    private $userTable;
    private $scheduleTable;
    private $approvalTable;

    public function __construct(DatabaseTable $priorityTable, DatabaseTable $userTable, DatabaseTable $scheduleTable, DatabaseTable $approvalTable)
    {
        $this->priorityTable = $priorityTable;
        $this->userTable = $userTable;
        $this->scheduleTable = $scheduleTable;
        $this->approvalTable = $approvalTable;
    }


    public function getPriorityOrder()
    {
        $priorityOrder = $this->priorityTable->findAll('priority DESC');
        $titile = "Priority Order";
        return [
            'template' => 'admin.priority.html.php',
            'title' => $titile,
            'variables' => [
                'priorityOrder' => $priorityOrder
            ]
        ];
    }

    public function savePriorityOrder()
    {
    }

    public function listSchedule()
    {
        if (isset($_GET['filter'])) {
            $filter = $_GET['filter'];
            foreach ($filter as $key => $value) {
                if ($value == null || $value = '') {
                    unset($filter[$key]);
                }
            }
            if(empty($filter)){
                $result = $this->scheduleTable->findAll();
            }else{
                $result = $this->scheduleTable->findMultiColumn($filter);
            }
        } else {
            $result = $this->scheduleTable->findAll();
        }
        $title = "Edit Schedule";
        return [
            'template' => 'admin.editschedule.html.php',
            'title' => $title,
            'variables' => [
                'result' => $result,
                'filter' => $filter
            ]
        ];
    }

    public function editSchedule()
    {
        $filter = $_POST['filter'];
        $schedule = $_POST['schedule'];
        $this->scheduleTable->update($schedule);
        $urlString="";
        foreach($filter as $key=>$value){
            $urlString.="filter%5B".$key."%5D=".$value."&";
        }
        $urlString=rtrim($urlString,'&');
        header("Location:listschedule?".$urlString);
    }

    public function deleteSchedule()
    {
        $filter = $_POST['filter'];
        $id=$_POST['id'];
        $this->scheduleTable->deleteWhere('id',$id);
        $urlString="";
        foreach($filter as $key=>$value){
            $urlString.="filter%5B".$key."%5D=".$value."&";
        }
        $urlString=rtrim($urlString,'&');
        header("Location:listschedule?".$urlString);
    }

    public function addSchedule()
    {
        $filter = $_POST['filter'];
        $schedule = $_POST['schedule'];
        $this->scheduleTable->save($schedule);
        $urlString="";
        foreach($filter as $key=>$value){
            $urlString.="filter%5B".$key."%5D=".$value."&";
        }
        $urlString=rtrim($urlString,'&');
        header("Location:listschedule?".$urlString);
    }
}
