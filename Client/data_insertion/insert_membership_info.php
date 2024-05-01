
<style>
    input,section{
        border:1px solid black;
        outline:none;

    }
    
table {
  font-family: arial, sans-serif;
  border:3px solid orange;
  border-collapse: collapse;

}

td, th {
  text-align: left;
  padding: 8px;
}
.Containe_m{
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
<div class="container">
    <div class="">
        <div class="">
            <h1>Membership Entry</h1>
        </div>
        <table>
            <tr>
                <td><input type="number" class="" id="id" placeholder="ID" value="" onblur="autoinfo()"></td>
                <td><input type="text" class="" id="first_name" placeholder="First Name"></td>
            </tr>
            <tr>
                <td><input type="text" class="" id="last_name" placeholder="Last Name"></td>
                <td class="flex flex-col">Date of peyment:<input type="date" class="" id="date_of_peyment"></td>

            </tr>
            <tr class="flex">
                <td class="flex flex-col">Subscription Period(Month)<input type="number" class="" onblur="autodatee()" id="month_peyment"></td>
                <td class="flex flex-col">Month rate <input type="number" id="rate" onblur="actualamountCalculation()"></td>
            </tr>
            <tr>
            <td class="flex flex-col">Actual Amount<input type="number" id="actual_amount"></td>
            <td class="flex flex-col">Discount Given<input type="number" id="discount" onblur="discountamountCalculation()"></td>
            <td class="flex flex-col">Amount Paid<input type="number" id="amount"></td>
            </tr>
            <tr>
                <td class="flex flex-col">Date of expiry:<input type="date" class="" id="date_of_expiry"></td>
                <td class="flex flex-col">FingerPrint template<input type="file" name="file" id="fileInput"></td>
            </tr>
            <tr>
                <td>
                <button type="submit" id="save" name="submitt" onclick="submitMembershipInfo();submitMembershiptemp();" class="border w-20 text-white bg-orange-400 hover:bg-orange-500 px-2 py-1 rounded-md mt-5 mb-8 ease-in-out duration-500">Submit</button>
                </td>
            </tr>
        </table>
</div>
</div>

<div class="load_container mt-10">
    <div class="flex justify-between">
        <h1>Membership info</h1>
        <input type="text" placeholder="Search" id="membershipSearch" onkeyup="membershipSearch()" autocomplete="off">
    </div>
    <table id="table_datapm" class="mt-5 border-separate border-spacing-2 border border-slate-500">
        <tr>
            <th class="border bg-green-200">ID</th>
            <th class="border bg-green-200">First Name</th>
            <th class="border bg-green-200">Last Name</th>
            <th class="border bg-green-200">Date of Peymet</th>
            <th class="border bg-green-200">Actual Amount</th>
            <th class="border bg-green-200">Discount Given</th>
            <th class="border bg-green-200">Amount Piad</th>
            <th class="border bg-green-200">Date of expiry</th>
        </tr>
    </table>
</div>


<div class="Containe_m w-full">
    <div class="inner-contain w-fit">
        <div class="">
            <h1 class="text-lg font-bold">Edit membership Entry</h1>
        </div>
        <table>
            <tr>
                <td><input type="number" class="" id="idm" placeholder="ID" value=""></td>
                <td><input type="text" class="" id="first_namem" placeholder="First Name"></td>

            </tr>
            <tr>
                <td><input type="text" class="" id="last_namem" placeholder="Last Name"></td>
            </tr>
            <tr>
                <td class="flex flex-col justify-around">Date of Peyment<input type="date" id="date_of_peymentm"></td>
                <td class="flex flex-col justify-around">Actual amount<input type="number" class="" id="actual_amountm"></td>

            </tr>
            <tr>
            <td class="flex flex-col justify-around">Discount Given<input type="number" class="" id="discountm"></td>
            <td class="flex flex-col justify-around">Amount Paid<input type="number" class="" id="amountm"></td>

            </tr>
            <tr>
            <td class="flex flex-col justify-around">Date of expiry<input type="date" class="" id="date_of_expirym"></td>
            </tr>
            <tr>
                <td><button type="submit" id="save" onclick="saveFromEditedInsertMembershipInfo()" class="border w-20 text-white bg-orange-400 hover:bg-orange-500 px-2 py-1 rounded-md mt-5 mb-8 ease-in-out duration-500">Save</button></td>
                <td><button type="submit" id="close" onclick="closebtnofMembership()" class="border w-20 text-white bg-red-400 hover:bg-orange-500 px-2 py-1 rounded-md mt-5 mb-8 ease-in-out duration-500">Close</button></td>
            </tr>
        </table>
    </div>
</div>
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../scripts/insert_membership_info.js"></script>
<script src="../scripts/load_membership_info.js"></script>

