<?php
    include '/opt/lampp/htdocs/UniCS/'.'./includes/DatabaseConnection.php';
    $userId=$_GET['userid']??7;
    $notiId=$_GET['notiId']??47;
    try{
        $pdo->query('UPDATE `notification` SET `status`=0 WHERE `id`='.$notiId);
        $query='SELECT COUNT(*) FROM `notification` WHERE `userid`='.$userId;
        $totalNoti=$pdo->query($query);
        echo $totalNoti->fetch()[0];
    }catch(Exception $e){
        echo $e;
    }
   
?>