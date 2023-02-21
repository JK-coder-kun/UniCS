<?php

namespace Unics\Controllers;

use \Common\DatabaseTable;
use DateTime;
use Exception;
use \Unics\Entity\Request;

class RequestOperator
{
    public $request;
    private $scheduleTable;
    private $approvalTable;
    private $notificationTable;
    private $priorityTable;
    private $requestTable;
    private $userTable;
    private $dateArray;
    public function __construct(
        DatabaseTable $scheduleTable,
        DatabaseTable $approvalTable,
        DatabaseTable $requestTable,
        DatabaseTable $notificationTable,
        Request $request = null
    ) {
        date_default_timezone_set('Asia/Yangon');
        for ($i = 0; $i < 7; $i++) {
            $date=strtolower(date('y-m-d', strtotime("+" . $i . " days")));
            $day=strtolower(date('l', strtotime("+" . $i . " days")));
            $this->dateArray[$day] =$date ;
        }
        if ($request != null) $this->request = $request;
        $this->scheduleTable = $scheduleTable;
        $this->approvalTable = $approvalTable;
        $this->requestTable = $requestTable;
        $this->notificationTable = $notificationTable;
        $pdo = $this->notificationTable->getDatabase();
        $this->priorityTable = new \Common\DatabaseTable($pdo, 'priority', 'priority');
        $this->userTable = new \Common\DatabaseTable($pdo, 'user', 'id', '\Unics\Entity\User');
    }

    public function isToday()
    {
        //check if requested day is today or not
        if ($this->request->day == strtolower(date('l'))) {
            return true;
        } else {

            return false;
        }
    }
    public function checkTodayRequest()
    {
        date_default_timezone_set('Asia/Yangon');
        //echo date('h:i');
        switch (true) {
            case (time() < strtotime("08:30:00")):
                $currentPeriod = 0;
                break;
            case (time() < strtotime("09:40:00")):
                $currentPeriod = 1;
                break;
            case (time() < strtotime("10:50:00")):
                $currentPeriod = 2;
                break;
            case (time() < strtotime("13:40:00")):
                $currentPeriod = 3;
                break;
            case (time() < strtotime("14:50:00")):
                $currentPeriod = 4;
                break;
            case (time() < strtotime("15:00:00")):
                $currentPeriod = 5;
                break;
            default:
                $currentPeriod = 6;
                break;
        }
        
        if ($this->request->period <= $currentPeriod) {
            return false;
        }
        $this->approveRequest([$this->request]);
        return true;
    }
    public function checkFree($request)
    {
        $approvals = $this->approvalTable->findByThreeColumn(
            'period',
            $request->period,
            'day',
            $request->day,
            'roomNo',
            $request->roomNo
        );
        $schedules = $this->scheduleTable->findByThreeColumn(
            'period',
            $request->period,
            'day',
            $request->day,
            'roomNo',
            $request->roomNo
        );
        return (empty($approvals) && empty($schedules));
    }


    public function approveRequest($requests)
    {
        foreach ($requests as $request) {
            $this->requestTable->deleteWhere('id', $request->id);
           // echo "</br>reqesteddate=".$this->dateArray[$request->day]."</br>";
            $requestArray = [
                'roomNo' => $request->roomNo,
                'day' => $request->day,
                'period' => $request->period,
                'date'=>$this->dateArray[$request->day],
                'reason' => $request->reason,
                'userId' => $request->userId
            ];
            try {
                $this->approvalTable->save($requestArray);
            } catch (Exception $e) {
                echo $e;
            }
        }
        $this->sendApproval($requests);
    }
    public function sendApproval($requests)
    {
        foreach ($requests as $request) {
            $notiText = "Your request has been approved!</br>Room No:" . $request->roomNo
                . ",  Time :" . $request->day . ", period " . $request->period;
            $notiInfo = [
                'userId' => $request->userId, 'status' => 1, 'time' => new DateTime(),
                'notiText' => $notiText
            ];
            $this->notificationTable->save($notiInfo);
        }
    }

    public function rejectRequest($rejections)
    {
        foreach ($rejections as $rejection) {
            $this->requestTable->deleteWhere('id', $rejection->id);
        }
        $this->sendRejection($rejections);
    }
    public function sendRejection($rejections)
    {
        foreach ($rejections as $rejection) {
            $notiText = "Your request has been rejected!</br>For room No:" . $rejection->roomNo
                . "\nAt :" . $rejection->day . ", period " . $rejection->period;
            $notiInfo = [
                'userId' => $rejection->userId, 'status' => 1, 'time' => new DateTime(),
                'notiText' => $notiText
            ];
            $this->notificationTable->save($notiInfo);
        }
    }



    public function compareRequests($requests)
    {
        //echo "</br>in compareRequests</br>";
        $priorityObjs = $this->priorityTable->findAll('priority DESC');
        foreach ($priorityObjs as $priorityObj) {
            $priority[$priorityObj->reason] = $priorityObj->priority;
        }
        //print_r($priority);
        //$highestPriority=sizeof($priority);
        $chosenReq = $requests[0];
        foreach ($requests as $request) {
            $user = $this->userTable->findById($request->userId);
            //print_r($user);
            if ($user->role == 'admin') {
                $chosenReq = $request;
            }else if ($priority[$request->reason] > $priority[$chosenReq->reason]) {
                $chosenReq = $request;
            } else if ($priority[$request->reason] == $priority[$chosenReq->reason]) {
                if ($request->date < $chosenReq->date) {
                    $chosenReq = $request;
                }
            }
            // echo "Chosenrequest is ";
            // print_r($chosenReq);echo '</br>';
        }
        //echo "</br>rejections";
        $chosenIndex = array_search($chosenReq, $requests);
        array_splice($requests, $chosenIndex, 1);
        //echo "rejected request are";print_r($requests);echo "</br>";
        $this->rejectRequest($requests);
        return $chosenReq;
    }

    //check every request that was sent before today
    public function checkRequests()
    {
        $date = new DateTime();
        $requestToCheck = $this->requestTable->findRequestByDate($date->format('y-m-d'));


        if ($requestToCheck == null) {
            return true;
        } else {
            //echo "there exisit request </br>";
            $size = sizeof($requestToCheck);
            $conflicts = array();
            for ($a = 0; $a < $size; $a++) {
                //remove all elements from conflicts array
                $conflicts = array_diff($conflicts, $conflicts);
                $isThereConflict = false;
                $firstConflictAdded=false;
                for ($b = $a + 1; $b < $size; $b++) {
                    if (
                        $requestToCheck[$a]->day == $requestToCheck[$b]->day &&
                        $requestToCheck[$a]->period == $requestToCheck[$b]->period &&
                        $requestToCheck[$a]->roomNo == $requestToCheck[$b]->roomNo
                    ) {
                        $isThereConflict = true;
                        if(!$firstConflictAdded){
                            $firstConflictAdded=true;
                            $conflicts[] = $requestToCheck[$a];
                        }
                        $conflicts[]=$requestToCheck[$b];
                        $temp = $requestToCheck[$a + 1];
                        $requestToCheck[$a + 1] = $requestToCheck[$b];
                        $requestToCheck[$b] = $temp;
                        $a++;
                    }
                }
                // echo ($isThereConflict) ? "conflict has" : "conflict don't have";
                // print_r($conflicts);
                $requestsToApprove[] = $isThereConflict ? $this->compareRequests($conflicts) : $requestToCheck[$a];
            }

            $this->approveRequest($requestsToApprove);
        }
    }

    public function deleteApproval(){
        // $dateFilter='(date<'.date('y-m-d').')';
        // $this->approvalTable->deleteWhere($dateFilter,true);
        $this->approvalTable->deleteApproval(date('y-m-d'));
    }

    public function deleteNotification(){
        $this->notificationTable->deleteNotification(date('y-m-d', strtotime("-" . 7 . " days")));
    }
}
