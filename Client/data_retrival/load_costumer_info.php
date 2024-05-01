<div class="load_container">
    <div class="flex justify-between">
        <h1>Costumer's info</h1>
        <input type="text" placeholder="Search" id="costumerSearch" onkeyup="costumerSearch()" autocomplete="off">
    </div>
    <table id="table_data" class="border-separate border-spacing-2 border border-slate-500">
        <tr>
            <th class="border bg-green-200">ID</th>
            <th class="border bg-green-200">First Name</th>
            <th class="border bg-green-200">Last Name</th>
            <th class="border bg-green-200">Gender</th>
            <th class="border bg-green-200">Date of Birth</th>
            <th class="border bg-green-200">Age</th>
            <th class="border bg-green-200">Date of Joining</th>
            <th class="border bg-green-200">Phone</th>
            <th class="border bg-green-200">Email</th>
            <th class="border bg-green-200">Address</th>
        </tr>
    </table>
</div>
<style>
    .Containe{
        z-index: 2;
        position: fixed;
        height:100%;
        width:100%;
        background:rgba(0,0,0,0.3);
        top:0;
        left:0;
        display:none;
        
    }
    .inner-contain{
        background:white;
        position: relative;
        top:20%;
        left:30%;

    }
    input,section{
        border:1px solid black;
        outline:none;
        padding:2px;
    }
    
table {
  font-family: arial, sans-serif;
  background:white;

}

td, th {
  text-align: left;
  padding: 8px;
}
    select{
        outline:none;
    }
</style>
<div class="Containe w-full">
    <div class="inner-contain w-fit">
        <div class="">
            <h1 class="text-lg font-bold">Edit Costumer Entry</h1>
        </div>
        <table>
            <tr>
                <td><input type="number" class="" id="id" placeholder="ID" value=""></td>
                <td><input type="text" class="" id="first_name" placeholder="First Name"></td>

            </tr>
            <tr>
                <td><input type="text" class="" id="last_name" placeholder="Last Name"></td>
                <td class="flex flex-col justify-around">Gender<select name="gender" id="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select></td>
            </tr>
            <tr>
                <td class="flex flex-col justify-around">Date of Birth<input type="date" id="date_of_birth" name="date_of_birth" onblur="getAge()"></td>
                <td><input type="number" name="age" id="age" placeholder="Age"></td>
            </tr>
            <tr>
                <td class="flex flex-col justify-around">Date of joining<input type="date" class="" id="date_of_joining" placeholder="Date of Joining"></td>
                <td><input type="number" name='phone' id="phone" placeholder="Phone Number"></td>
            </tr>
            <tr>
                <td><input type="email" id="email" placeholder="Email"></td>
                <td><input type="text" class="" id="address" placeholder="Address"></td>
            </tr>
            <tr>
                <td><button type="submit" id="save" onclick="saveFromEditedInsertCostumerInfo()" class="border w-20 text-white bg-orange-400 hover:bg-orange-500 px-2 py-1 rounded-md mt-5 mb-8 ease-in-out duration-500">Save</button></td>
                <td><button type="submit" id="close" onclick="closebtnofcostumer()" class="border w-20 text-white bg-red-400 hover:bg-orange-500 px-2 py-1 rounded-md mt-5 mb-8 ease-in-out duration-500">Close</button></td>
            </tr>
        </table>
    </div>
</div>
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../scripts/load_costumer_info.js"></script>
