<?php
namespace Unics\Entity;

class Schedule{
    public $roomNo;
    public $period;
    public $day;
    public $section;
    public $subjectCode;
    
    public function showSubject(){
        return $this->subjectCode;
    }
}