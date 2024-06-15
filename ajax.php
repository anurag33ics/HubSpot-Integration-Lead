<?php
ob_start();
$action = $_GET['action'];
include 'ajax-class-aman.php';
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

if($action=="comparedata"){
    $res= $crud->comparedata();
    if($res)
     echo $res;
}


if($action=="verifyLogin"){
    $res= $crud->verifyLogin();
    if($res)
     echo $res;
}


if($action=="logout"){
    $res= $crud->logout();
    if($res)
     echo $res;
}
if($action=="getDiffData"){
    $res= $crud->getDiffData();
    if($res)
     echo $res;
}

