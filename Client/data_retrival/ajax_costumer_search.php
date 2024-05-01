<?php
$conn=mysqli_connect(
    "localhost",
    "root",
    "",
    "biodwar"
);
$search=$_POST["search"];

$sql="SELECT * FROM costumer_info WHERE first_name LIKE '%{$search}%' OR last_name LIKE '%{$search}%'";
$result=mysqli_query($conn,$sql);
$output="";
    if(mysqli_num_rows($result)>0){
                $output='<table id="table_data" class="border-separate border-spacing-2 border border-slate-500">
                <tr>
                    <th class="border bg-green-200">ID</th>
                    <th class="border bg-green-200">First Name</th>
                    <th class="border bg-green-200">Last Name</th>
                    <th class="border bg-green-200">Gender</th>
                    <th class="border bg-green-200">Date of Birth</th>
                    <th class="border bg-green-200">Age</th>
                    <th class="border bg-green-200">Phone</th>
                    <th class="border bg-green-200">Date of Joining</th>
                    <th class="border bg-green-200">Address</th>
                    <th class="border bg-green-200">Email</th>
                    <th class="border bg-green-200">Edit</th>
                    <th class="border bg-green-200">Delete</th>

                </tr>';
                while($row=mysqli_fetch_assoc($result)){
                    $output.="<tr'>
                    <td class='border bg-green-100'>{$row['id']}</td>
                    <td class='border bg-green-100'>{$row['first_name']}</td>
                    <td class='border bg-green-100'>{$row['last_name']}</td>
                    <td class='border bg-green-100'>{$row['gender']}</td>
                    <td class='border bg-green-100'>{$row['date_of_birth']}</td>
                    <td class='border bg-green-100'>{$row['age']}</td>
                    <td class='border bg-green-100'>{$row['phone']}</td>
                    <td class='border bg-green-100'>{$row['date_of_joining']}</td>
                    <td class='border bg-green-100'>{$row['address']}</td>
                    <td class='border bg-green-100'>{$row['email']}</td>
                    <td class='border bg-green-400'><button id='' data-eid='{$row['id']}' class='edit_btn cursor-pointer p-1' style='border:0;border-radius:5px;'>Edit</button></td>
                    <td class='border bg-red-400'><button id='' data-id='{$row['id']}' class='delete_btn cursor-pointer p-1' style='border:0;border-radius:5px;'>Delete</button></td>
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