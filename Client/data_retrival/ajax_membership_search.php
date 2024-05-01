<?php
$conn=mysqli_connect(
    "localhost",
    "root",
    "",
    "biodwar"
);
$search=$_POST["search"];

$sql="SELECT * FROM memberships WHERE first_name LIKE '%{$search}%' OR last_name LIKE '%{$search}%'";
$result=mysqli_query($conn,$sql);
$output="";
    if(mysqli_num_rows($result)>0){
                $output='<table id="table_datapm" class="border-separate border-spacing-2 border border-slate-500">
                <tr>
                <th class="border bg-green-200">ID</th>
                <th class="border bg-green-200">First Name</th>
                <th class="border bg-green-200">Last Name</th>
                <th class="border bg-green-200">Date of Peymet</th>
                <th class="border bg-green-200">Actual Amount</th>
                <th class="border bg-green-200">Discount Given</th>
                <th class="border bg-green-200">Amount Piad</th>
                <th class="border bg-green-200">Date of expiry</th>
                    <th class="border bg-green-200">Edit</th>
                    <th class="border bg-green-200">Delete</th>

                </tr>';
                while($row=mysqli_fetch_assoc($result)){
                    $output.="<tr'>
                    <td class='border bg-green-100'>{$row['id']}</td>
                    <td class='border bg-green-100'>{$row['first_name']}</td>
                    <td class='border bg-green-100'>{$row['last_name']}</td>
                    <td class='border bg-green-100'>{$row['date_of_peyment']}</td>
                    <td class='border bg-green-100'>{$row['actual_amount']}</td>
                    <td class='border bg-green-100'>{$row['discount_given']}</td>
                    <td class='border bg-green-100'>{$row['amount_paid']}</td>
                    <td class='border bg-green-100'>{$row['date_of_expiry']}</td>
                    <td class='border bg-green-400'><button id='' data-epmid='{$row['id']}' class='edit_btn_m cursor-pointer p-1' style='border:0;border-radius:5px;'>Edit</button></td>
                    <td class='border bg-red-400'><button id='' data-mid='{$row['id']}' class='delete_btn_m cursor-pointer p-1' style='border:0;border-radius:5px;'>Delete</button></td>

                    </tr>";
                }
            $output .="</table>";
            mysqli_close($conn);
            echo $output;
    }
    else{
        return 1;
    }
?>