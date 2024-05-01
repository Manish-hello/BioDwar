<?php
$conn=mysqli_connect(
    "localhost",
    "root",
    "",
    "biodwar"
);
$select1=mysqli_query($conn,"SELECT * FROM costumer_info");
$countt1=mysqli_num_rows($select1);
$select2=mysqli_query($conn,"SELECT * FROM trainer_info");
$countt2=mysqli_num_rows($select2);
$select3=mysqli_query($conn,"SELECT SUM(amount_paid) AS sum FROM `memberships`");
while($rows=mysqli_fetch_assoc($select3)){
    $sum=$rows['sum'];
}
$return=array('costumercount' => "$countt1",'trainercount' => "$countt2",'amount' => "$sum");
mysqli_close($conn);
echo json_encode($return);
?>