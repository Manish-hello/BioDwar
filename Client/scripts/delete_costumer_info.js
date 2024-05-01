$(document).on("click",".delete_btn",function(){
    var costumerId=$(this).data("id");
    var element=this;
    $.ajax({
        url:"../data_delete&edit/ajax_costumer_info_delete.php",
        type:"POST",
        data:{id:costumerId},
        success:function(data){
            var arrey=$.parseJSON(data);
            alert(data);
            if(arrey.success==0){
                $(element).closest("tr").fadeOut();
            }
            else{
                alert("Cant delete recors");
            }
        }
    });
});