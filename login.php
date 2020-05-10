<?php
session_start();
require 'conn.php';
global $conn;

$date = date('Y-m-d H:i:s');

if(isset($_POST['login'])) {
    if(isset($_POST['id']) && !empty($_POST['id']))
    $id=$_POST['id'];
    else echo "please enter your id";
}

if (!empty($id)){
    $query = "SELECT * FROM employees WHERE  id = '$id' ";
    $runquery = mysqli_query($conn , $query);
    $rows = mysqli_num_rows($runquery);
    
    if($rows>0){
        $query1 = "INSERT INTO `daily_login` (`emp_id`,`login_date`) VALUES ('$id','$date')";
        $runquery1 = mysqli_query($conn,$query1);
        if($runquery1){
            $_SESSION['id']=$id;
            $_SESSION['date']=$date;
            header('location:logout.php');
        }
    }
    else echo "incorrect ID";
}

?>
