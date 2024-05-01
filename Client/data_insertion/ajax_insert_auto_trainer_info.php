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
$sql="SELECT * FROM trainer_info WHERE id='$id'";
 $check=mysqli_query($conn,$sql);
if(mysqli_num_rows($check)>0){
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $aid=$row['id'];
    $afirst=$row['first_name'];
    $alast=$row['last_name'];
    $agender=$row['gender'];
    $adob=$row['date_of_birth'];
    $aage=$row['age'];
    $aphone=$row['phone'];
    $adoj=$row['date_of_joining'];
    $aaddress=$row['address'];
    $aemail=$row['email'];
    $return=array('aid' => "$aid",'afirst' => "$afirst",'alast' => "$alast",'agender' => "$agender",'adob' => "$adob",'aage' => "$aage",'aphone' => "$aphone",'adoj' => "$adoj",'aaddress' => "$aaddress",'aemail' => "$aemail");
    mysqli_close($conn);
    echo json_encode($return);
}
else{
    echo "0";
}
?>