<?php
$conn=mysqli_connect(
    "localhost",
    "root",
    "",
    "biodwar"
);
$id=$_POST["id"];
$first_name=$_POST["first_name"];
$last_name=$_POST["last_name"];
$gender=$_POST["gender"];
$date_of_birth=$_POST["date_of_birth"];
$age=$_POST["age"];
$phone=$_POST["phone"];
$date_of_joining=$_POST["date_of_joining"];
$address=$_POST["address"];
$email=$_POST["email"];
$sql="UPDATE costumer_info SET first_name='{$first_name}',last_name='{$last_name}',gender='{$gender}',date_of_birth='{$date_of_birth}',age='{$age}',phone='{$phone}',date_of_joining='{$date_of_joining}',address='$address',email='{$email}'  WHERE id='$id'";

    if(mysqli_query($conn,$sql)){
        echo "0";
    }
    else{
        echo "1";
    }
?>