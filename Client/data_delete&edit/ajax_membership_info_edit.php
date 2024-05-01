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
$dop=$_POST["date_of_peyment"];
$aa=$_POST["actual_amount"];
$discount=$_POST["discount"];
$amount=$_POST["amount"];
$doe=$_POST["date_of_expiry"];
$query1="INSERT INTO oldmemberships VALUES($id,'$first_name','$last_name','$dop',$aa,$discount,$amount,'$doe')";
mysqli_query($conn,$query1);
$sql="UPDATE memberships SET first_name='{$first_name}',last_name='{$last_name}',date_of_peyment='{$dop}',actual_amount='{$aa}',discount_given='{$discount}',amount_paid='{$amount}',date_of_expiry='{$doe}'  WHERE id='$id'";

    if(mysqli_query($conn,$sql)){
        echo "0";
    }
    else{
        echo "1";
    }
?>