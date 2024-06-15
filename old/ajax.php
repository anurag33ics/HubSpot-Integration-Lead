<?php
ob_start();
$action = $_GET['action'];
include 'ajax-class.php';
$crud = new Action();

if($action=="getdata"){
    $res= $crud->getdata();
    if($res)
     echo $res;
}
if($action=="importdata"){
    $res= $crud->importdata();
    if($res)
     echo $res;
}
