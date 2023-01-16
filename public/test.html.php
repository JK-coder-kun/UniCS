<?php
include '/opt/lampp/htdocs/UniCS/'.'./includes/DatabaseConnection.php';
include '/opt/lampp/htdocs/UniCS/'.'./classes/Ninja/DatabaseTable.php';
$scheduleTable=new DatabaseTable($pdo,'user','id');
$schedules=$scheduleTable->findByTwoColumn('day','monday','period',1);
echo $schedules;