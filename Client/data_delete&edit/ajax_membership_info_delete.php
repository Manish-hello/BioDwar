<?php
    $conn=mysqli_connect(
        "localhost",
        "root",
        "",
        "biodwar"
    );
    $memberId=$_POST["id"];
        $filePath1="../fp_templates/".$memberId;
        $filePath2="../../ardunio/".$memberId;

        unlink($filePath1);
        unlink($filePath2);

        $query = "DELETE FROM memberships WHERE id='$memberId'";
        mysqli_query($conn,$query);
        $success=0;
        $fail=1;
        $return=array('success' => "$success",'fail' => "$fail");
        echo json_encode($return);
?>