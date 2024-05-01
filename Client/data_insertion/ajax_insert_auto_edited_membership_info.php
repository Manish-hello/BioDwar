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
$sql="SELECT * FROM memberships WHERE id='$id'";
 $check=mysqli_query($conn,$sql);
if(mysqli_num_rows($check)>0){
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $aid=$row['id'];
    $afirst=$row['first_name'];
    $alast=$row['last_name'];
    $adop=$row['date_of_peyment'];
    $aaa=$row['actual_amount'];
    $ad=$row['discount_given'];
    $aa=$row['amount_paid'];
    $adoe=$row['date_of_expiry'];
    $return=array('aid' => "$aid",'afirst' => "$afirst",'alast' => "$alast",'adop' => "$adop",'aaa' => "$aaa",'ad' => "$ad",'aa' => "$aa",'adoe' => "$adoe");
    mysqli_close($conn);
    echo json_encode($return);
}
else{
    echo "0";
}
?>