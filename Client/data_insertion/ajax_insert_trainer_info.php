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
$duplicate=mysqli_query($conn,"SELECT * FROM trainer_info WHERE id='$id'");
if(mysqli_num_rows($duplicate)>0){
   return "Id already taken";
}
else{
    $query="INSERT INTO trainer_info VALUES($id,'$first_name','$last_name','$gender','$date_of_birth','$age','$date_of_joining','$phone','$email','$address')";
    mysqli_query($conn,$query);
    return "Registration successful!";
}
?>

