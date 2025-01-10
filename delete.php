<?php
session_start();
include("connection.php");
include("session.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id = $id";
    if(mysqli_query($conn,$sql)){
        header('location:dashoboard.php');
    }else{
        echo "Error :".$sql."<br>".mysqli_error($conn);
    }
}

?>