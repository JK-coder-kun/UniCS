<?php
namespace Unics\Entity;
class Request{
    public $id;
    public $roomNo;
    public $period;
    public $day;
    //public $section;
    //public $subjectCode;
    public $reason;
    public $userId;

    public function __construct($requestForm=null)
    {
        if($requestForm!=null){
            $this->roomNo=$requestForm['roomNo'];
            $this->period=$requestForm['period'];
            $this->day=$requestForm['day'];
            $this->reason=$requestForm['reason'];
            $this->userId=$requestForm['userId'];
        }
        
    }
}