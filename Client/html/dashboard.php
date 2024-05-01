<style>
    .inside1,.inside2,.inside3,.inside4{
        justify-content:center;
    }
    input{
        outline:none;
    }
    .save-btn{
        border:1px solid black;
        height:25px;
        width:50px;
        background:orange;
        color:white;
    }
</style>
<div class="content flex justify-around mt-5 text-white">
    <div class="inside1 shadow-lg bg-orange-500 w-1/3 mr-5 rounded-md h-20 flex flex-col">
        <h1 class="ml-3">Number of Users</h1>
        <h3 class="ml-3 text-xl" id="users"></h3>
    </div>
    <div class="inside2 shadow-lg bg-red-500 w-1/3 mr-5 rounded-md flex flex-col">
        <h1 class="ml-3">Total Trainers</h1>
        <h3 class="ml-3 text-xl" id="trainer"></h3>
    </div>
    <div class="inside3 shadow-lg bg-green-500 w-1/3 mr-5 rounded-md flex flex-col">
        <h1 class="ml-3">Month Revinue</h1>
        <h3 class="ml-3 text-xl" id="revinue"></h3>
    </div>
</div>

<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../scripts/counting_dashboard_info.js"></script>
