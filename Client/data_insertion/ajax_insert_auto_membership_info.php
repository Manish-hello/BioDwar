<?php
     $conn=mysqli_connect(
        "localhost",
        "root",
        "",
        "biodwar"
    );
    $id=$_POST['id'];
    date_default_timezone_set('Asia/Kathmandu');
    $currentdate=date('Y-m-d');
    $sql="SELECT first_name,last_name FROM costumer_info WHERE id='$id'";
    $check=mysqli_query($conn,$sql);
    if(mysqli_num_rows($check)>0){
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        $first=$row['first_name'];
        $last=$row['last_name'];
        $return=array('first' => "$first",'last' => "$last",'date'=>"$currentdate");
        mysqli_close($conn);
        echo json_encode($return);
    }
    else{
        echo "0";
    }
    
?>