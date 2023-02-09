<?php
    include '/opt/lampp/htdocs/UniCS/'.'./includes/DatabaseConnection.php';
    $userId=$_GET['userId'];
    $notiId=$_GET['notiId'];
    //echo $userId."</br>".$notiId;
    try{
        $pdo->query('UPDATE `notification` SET `status`=0 WHERE `id`='.$notiId);
        $query='SELECT COUNT(*) FROM `notification` WHERE `userid`='.$userId.' AND `status`=1';
        $totalNoti=$pdo->query($query);
        echo $totalNoti->fetch()[0];
    }catch(Exception $e){
        echo $e;
    }
   
?>