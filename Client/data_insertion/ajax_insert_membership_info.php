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
    $date_of_peyment=$_POST["date_of_peyment"];
    $date_of_expiry=$_POST["date_of_expiry"];
    $actual_amount=$_POST["actual_amount"];
    $discount_given=$_POST["discount"];
    $amount_paid=$_POST["amount"];

    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $uploadPath = '../fp_templates/' . $fileName;
    $tosavefilepath='fp_templates/'.$id;
    move_uploaded_file($fileTmpPath, $uploadPath);
    $duplicatee=mysqli_query($conn,"SELECT * FROM memberships WHERE id='$id'");
    //to save the old membership data this can be repeated data
    $query1="INSERT INTO oldmemberships VALUES($id,'$first_name','$last_name','$date_of_peyment',$actual_amount,$discount_given,$amount_paid,'$date_of_expiry')";
    mysqli_query($conn,$query1);
    if(mysqli_num_rows($duplicatee)>0){
        echo $conn->error;
    }
    else{
        $query="INSERT INTO memberships VALUES($id,'$first_name','$last_name','$date_of_peyment',$actual_amount,$discount_given,$amount_paid,'$date_of_expiry','$tosavefilepath')";
        mysqli_query($conn,$query);
        echo "0";
    }
?>