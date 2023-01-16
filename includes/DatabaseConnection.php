<?php
try{
    $pdo = new PDO('mysql:host=localhost;dbname=UniCS;charset=utf8', 'admin','admin');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
    echo $e;
}