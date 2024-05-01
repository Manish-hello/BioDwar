function countt(){
    $.ajax({
        url:"../data_retrival/ajax_dashboard_count.php",
        type:"POST",
        data:{},
        success:function(data){
            var arrey=$.parseJSON(data);
            document.getElementById('users').innerText=arrey.costumercount;
            document.getElementById('trainer').innerText=arrey.trainercount;
            document.getElementById('revinue').innerText=arrey.amount;

            
        }
    });
}
