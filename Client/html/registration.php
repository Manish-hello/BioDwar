<!-- for php -->
<?php
include("connection.php");
if(isset($_POST['signup_btn'])){
    $name=$_POST["name"];
    $username=$_POST["username"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $confpassword=$_POST["confpassword"];
    $adminpassword=$_POST["adminpassword"];
    $adminpasscheck=mysqli_query($conn,"SELECT * FROM super_admin");
    $row=$adminpasscheck->fetch_array()[0]??'';
    if($row==$adminpassword){
        $duplicate=mysqli_query($conn,"SELECT * FROM admin_info WHERE username='$username' OR email='$email'");
        if(mysqli_num_rows($duplicate)>0){
            echo "<script>alert('Username or email already taken!');</script>";
        }
        else{
            if($password==$confpassword){
                $query="INSERT INTO admin_info VALUES('','$name','$username','$email','$password')";
                mysqli_query($conn,$query);
                echo "<script>alert('Registration Successful');</script>";
            }
            else{
                echo "<script>alert('Password doesnot match');</script>";
            }
        }
    }
    else{
        echo "<script>alert('wrong admin password');</script>";
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="../css/output.css">
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
    <div class="flex justify-center items-center h-screen">
        <div class="rounded-md p-6 w-96 border bg-blue-100 shadow-xl">
            <div class="flex justify-center">
                <h1 class="text-3xl font-bold text-orange-500">Signup</h1>
            </div>
            <hr class="mt-1">
            <div class="mt-3 ">
                <form action="" method="POST"  class="flex flex-col items-center" autocomplete="off">
                    <input type="text" name="name" id="name" placeholder="Enter name" class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-orange-400 mb-2 rounded-md">
                    <input type="text" name="username" id="username" placeholder="Enter Username" class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-orange-400 mb-2 rounded-md">
                    <input type="text" name="email" id="email" placeholder="Email" class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-orange-400 mb-2 rounded-md">
                    <input type="password" name="password" id="password" placeholder="Password" class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-orange-400 mb-2 rounded-md">
                    <input type="password" name="confpassword" id="confpassword" placeholder="Confirm Password" class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-orange-400 mb-2 rounded-md">
                    <input type="password" name="adminpassword" id="adminpassword" placeholder="Enter Admin Password" class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-orange-400 mb-2 rounded-md">
                    <button type="submit" name="signup_btn" class="border w-20 text-white bg-orange-400 hover:bg-orange-500 px-2 py-1 rounded-md mt-5 mb-8 ease-in-out duration-500">Signup</button>
                </form>
            </div>
            <div class="flex justify-around">
                <p>Already have an account?<a href="login" class="text-orange-400 hover:text-orange-500"> Login</a></p>
            </div>
   </div>
</div>
</body>
</html>



