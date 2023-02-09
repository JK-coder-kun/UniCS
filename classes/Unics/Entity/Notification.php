<?php
namespace Unics\Entity;
class Notification{
    public $id;
    public $userid;
    public $notiText;
    public $status;
    public $time;
    private $notificationTable;

    // public function __construct(\Common\DatabaseTable $notificationTable)
    // {
    //     $this->$notificationTable=$notificationTable;
    // }

    // public function changeSeenNotiStatus($notiId){
    //     $this->notificationTable->update(['id'=>$notiId,'status'=>0]);
    // }
}