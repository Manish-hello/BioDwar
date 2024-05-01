function loadDatam(){
    $.ajax({
        url:"../data_retrival/ajax_load_paid_membership_info.php",
        type:"POST",
        success:function(data){
            document.getElementById('table_datapm').innerHTML=data;
        }
    });
}
$(document).on("click",".edit_btn_m",function(){
    var fname=document.getElementById('first_namem').value;
    var lname=document.getElementById('last_namem').value;
    var dop=document.getElementById('date_of_peymentm').value;
    var aa=document.getElementById('actual_amountm').value;
    var discount=document.getElementById('discountm').value;
    var doe=document.getElementById('date_of_expirym').value;
    var amount=document.getElementById('amountm').value;
    var id=$(this).data("epmid");
$.ajax({
url:"../data_insertion/ajax_insert_auto_edited_membership_info.php",
type:"POST",
data:{id:id,first_name:fname,last_name:lname,date_of_peyment:dop,actual_amount:aa,discount:discount,amount:amount,date_of_expiry:doe},
success:function(data){
    
    if(data==0){
        alert("No such data");
    }
    else{
        $(".Containe_m").show();
        var arrey=$.parseJSON(data);
        document.getElementById('idm').value=arrey.aid;
        document.getElementById('first_namem').value=arrey.afirst;
        document.getElementById('last_namem').value=arrey.alast;
        document.getElementById('date_of_peymentm').value=arrey.adop;
        document.getElementById('actual_amountm').value=arrey.aaa;
        document.getElementById('discountm').value=arrey.ad;
        document.getElementById('date_of_expirym').value=arrey.adoe;
        document.getElementById('amountm').value=arrey.aa;
    }
}
});
});

function closebtnofMembership(){
$(".Containe_m").hide();
}


function saveFromEditedInsertMembershipInfo(){
    var id=document.getElementById('idm').value;
    var fname=document.getElementById('first_namem').value;
    var lname=document.getElementById('last_namem').value;
    var dop=document.getElementById('date_of_peymentm').value;
    var aa=document.getElementById('actual_amountm').value;
    var discount=document.getElementById('discountm').value;
    var doe=document.getElementById('date_of_expirym').value;
    var amount=document.getElementById('amountm').value;
$.ajax({
url:"../data_delete&edit/ajax_membership_info_edit.php",
type:"POST",
data:{id:id,first_name:fname,last_name:lname,date_of_peyment:dop,actual_amount:aa,discount:discount,amount:amount,date_of_expiry:doe},
success:function(data){
    if(data==0){
        $(".Containe_m").hide(); 
        loadDatam();
    }
    else{
        alert("canot update data");
    }
}
});
}
$(document).on("click",".delete_btn_m",function(){
    var costumerId=$(this).data("mid");
    var element=this;
    $.ajax({
        url:"../data_delete&edit/ajax_membership_info_delete.php",
        type:"POST",
        data:{id:costumerId},
        success:function(data){
            var arrey=$.parseJSON(data);
            if(arrey.success==0){
                $(element).closest("tr").fadeOut();
            }
            else{
                alert("Cant delete recors");
            }
        }
    });
});

function membershipSearch(){
    var search_val=document.getElementById('membershipSearch').value;
    $.ajax({
        url:"../data_retrival/ajax_membership_search.php",
        type:"POST",
        data:{search:search_val},
        success:function(data){
            $("#table_datapm").html(data);
        }
    });
}