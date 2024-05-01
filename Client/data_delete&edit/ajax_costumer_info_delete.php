<?php
    $conn=mysqli_connect(
        "localhost",
        "root",
        "",
        "biodwar"
    );
    $costumerId=$_POST["id"];
    $tables = array('costumer_info','memberships');
        foreach($tables as $table) {
        $query = "DELETE FROM $table WHERE id='$costumerId'";
        mysqli_query($conn,$query);
        $success=0;
        $fail=1;
        $return=array('success' => "$success",'fail' => "$fail");
        echo json_encode($return);
        }
?>