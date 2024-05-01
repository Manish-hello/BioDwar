<?php
    $conn=mysqli_connect(
        "localhost",
        "root",
        "",
        "biodwar"
    );
    $costumerId=$_POST["id"];
        $query = "DELETE FROM trainer_info WHERE id='$costumerId'";
        mysqli_query($conn,$query);
        $success=0;
        $fail=1;
        $return=array('success' => "$success",'fail' => "$fail");
        echo json_encode($return);
?>