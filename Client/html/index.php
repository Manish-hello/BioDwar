<?php
include("connection.php");
if(!isset($_SESSION['id'])){
    header("Location:login");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bio Dwar</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../css/output.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <style>
            .main-content {
                font-size: 10px;
            }
            @media (min-width:768px) {
                .main-content {
                    font-size: 18px;
                }
            }
            @media (min-width:1024px) {
                .main-content {
                    font-size: 19px;
                }
            }
    </style> -->
</head>
<body>
   <div class="flex gap-5 bg-gray-300" >
        <?php
            include("./sidebar.php");
        ?>
    
        <main class="main-content p-0 snap-x w-10/12" id="mainContent">

        </main>
   
    </div>

        <script src="../js/jquery.js"></script>
        <script src="../scripts/insert_costumer_info.js"></script>
        <script src="../scripts/delete_costumer_info.js"></script>
        <script src="../scripts/load_costumer_info.js"></script>

        <script src="../scripts/insert_membership_info.js"></script>
        <script src="../scripts/counting_dashboard_info.js"></script>
        <script src="../scripts/insert_trainer_info.js"></script>
<script src="../scripts/load_trainer_info.js"></script>
<script src="../scripts/load_membership_info.js"></script>

</body>
</html>




