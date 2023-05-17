<?php

function getnamePV($conn,$id){
    $sql = "SELECT name_th FROM `provinces` WHERE id ='".$id."'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
    return $result['name_th'];
}

function getnameAP($conn,$id){
    $sql = "SELECT name_th FROM `amphures` WHERE id ='".$id."'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
    return $result['name_th'];
}

function getnameDS($conn,$id){
    $sql = "SELECT name_th FROM `districts` WHERE id ='".$id."'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
    return $result['name_th'];
}
?>