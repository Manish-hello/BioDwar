function loadData(){
    $.ajax({
        url:"../data_retrival/ajax_load_costumer_info.php",
        type:"POST",
        success:function(data){
            document.getElementById('table_data').innerHTML=data;
        }
    });
}
//for auto insertion of data in edit of view costumer detail page
$(document).on("click",".edit_btn",function(){
           
            var fname=document.getElementById('first_name').value;
            var lname=document.getElementById('last_name').value;
            var gender=document.getElementById('gender').value;
            var dob=document.getElementById('date_of_birth').value;
            var age=document.getElementById('age').value;
            var phone=document.getElementById('phone').value;
            var doj=document.getElementById('date_of_joining').value;
            var address=document.getElementById('address').value;
            var email=document.getElementById('email').value;
            var id=$(this).data("eid");
    $.ajax({
        url:"../data_insertion/ajax_insert_auto_costumer_info.php",
        type:"POST",
        data:{id:id,first_name:fname,last_name:lname,gender:gender,date_of_birth:dob,age:age,phone:phone,date_of_joining:doj,address:address,email:email},
        success:function(data){
            if(data==0){
                alert("No such data");
            }
            else{
                $(".Containe").show();
                var arrey=$.parseJSON(data);
                document.getElementById('id').value=arrey.aid;
                document.getElementById('first_name').value=arrey.afirst;
                document.getElementById('last_name').value=arrey.alast;
                document.getElementById('gender').value=arrey.agender;
                document.getElementById('date_of_birth').value=arrey.adob;
                document.getElementById('age').value=arrey.aage;
                document.getElementById('phone').value=arrey.aphone;
                document.getElementById('date_of_joining').value=arrey.adoj;
                document.getElementById('address').value=arrey.aaddress;
                document.getElementById('email').value=arrey.aemail;
            }
        }
    });
});
function closebtnofcostumer(){
    $(".Containe").hide();
}
function saveFromEditedInsertCostumerInfo(){
            var id=document.getElementById('id').value;
            var fname=document.getElementById('first_name').value;
            var lname=document.getElementById('last_name').value;
            var gender=document.getElementById('gender').value;
            var dob=document.getElementById('date_of_birth').value;
            var age=document.getElementById('age').value;
            var phone=document.getElementById('phone').value;
            var doj=document.getElementById('date_of_joining').value;
            var address=document.getElementById('address').value;
            var email=document.getElementById('email').value;
    $.ajax({
        url:"../data_delete&edit/ajax_costumer_info_edit.php",
        type:"POST",
        data:{id:id,first_name:fname,last_name:lname,gender:gender,date_of_birth:dob,age:age,phone:phone,date_of_joining:doj,address:address,email:email},
        success:function(data){
            if(data==0){
                $(".Containe").hide(); 
                loadData();
            }
            else{
                alert("canot update data");
            }
        }
    });
}
function costumerSearch(){
    var search_val=document.getElementById('costumerSearch').value;
    $.ajax({
        url:"../data_retrival/ajax_costumer_search.php",
        type:"POST",
        data:{search:search_val},
        success:function(data){
            $("#table_data").html(data);
        }
    });
}