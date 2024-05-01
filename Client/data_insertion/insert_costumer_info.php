<style>
    input,section{
        border:1px solid black;
        outline:none;
        padding:2px;

    }
    
table {
  font-family: arial, sans-serif;
  border:3px solid orange;
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
    <div class="">
        <div class="">
            <h1 class="text-lg font-bold">New Costumer Entry</h1>
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
            <tr colspan="2">
                <td class="flex justify-center w-full">
                <button type="submit" id="save" onclick="saveFromInsertCostumerInfo()" class="border w-20 text-white bg-orange-400 hover:bg-orange-500 px-2 py-1 rounded-md mt-5 mb-8 ease-in-out duration-500">Submit</button>
                </td>
            </tr>
        </table>
</div>
</div>
<script src="../js/jquery.js" type="text/javascript"></script>
