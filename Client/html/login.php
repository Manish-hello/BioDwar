
<?php
include("connection.php");
if(isset($_SESSION['id'])){
    header("Location:index");
}
if(isset($_POST['login_btn'])){
    $username=$_POST["username"];
    $password=$_POST["password"];
    $result=mysqli_query($conn,"SELECT * FROM admin_info WHERE username='$username' OR email='$username'");
    $row=mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)>0){
        if($password==$row["password"]){
            $_SESSION["login"]=true;
            $_SESSION["id"]=$row["id"];
            header("Location:index");
        }
        else{
            echo "<script>alert('Wroong password');</script>";
        }
    }
    else{
        echo "<script>alert('User not registered');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/output.css">
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
    <div class="flex justify-center items-center h-screen">
        <div class="rounded-md p-6 w-96 border bg-blue-100 shadow-xl">
            <div class="flex justify-center">
                <h1 class="text-3xl font-bold text-orange-500">Login</h1>
            </div>
            <hr class="mt-1">
            <div class="mt-3 ">
                <form action="" method="POST"  class="flex flex-col items-center" autocomplete="off">
                    <input type="text" name="username" id="username" placeholder="Enter Username or Email" class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-orange-400 mb-2 rounded-md">
                    <input type="password" name="password" id="password" placeholder="Password" class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-orange-400 mb-2 rounded-md">
                    <button type="submit" name="login_btn" class="border w-20 text-white bg-orange-400 hover:bg-orange-500 px-2 py-1 rounded-md mt-5 mb-8 ease-in-out duration-500">Login</button>
                </form>
            </div>
            <div class="flex justify-around">
                <p>Already have an account?<a href="registration" class="text-orange-400 hover:text-orange-500"> Signup</a></p>
            </div>
   </div>
</div>
</body>
</html>


