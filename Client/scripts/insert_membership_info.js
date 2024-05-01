function autodatee(){
    var inputmonth=document.getElementById('month_peyment').value;
    const date=new Date();
    let day=date.getDate();
    let month=date.getMonth()+1;
    let year=date.getFullYear();
    let monthh=month+(+inputmonth);
    if(day<10)day='0'+day;
    if(monthh<10)monthh='0'+monthh;
    if(day>30){
        day=30;
    }
    if(monthh>12){
        console.log(23%12);
        if((monthh%12)==0){
            //i dont know why but it is giving 23%12=0,35%12=0 and so on js is broke is guess lol
            monthh=monthh/12;
            console.log(monthh);
            year=year+(+monthh);
        }
        else{
            flor=Math.floor(monthh/12);
            monthh=((monthh/12)-flor)*12;
            monthh=Math.round(monthh * 1000) / 1000;
            console.log(monthh);
            year=year+(+flor);
        }
        if(monthh<10)monthh='0'+monthh;

    }
    let fulldate=year+"-"+monthh+"-"+day;
    $('input[id="date_of_expiry"]').val(fulldate);
}

function autoinfo(){
    var id=document.getElementById('id').value;
    $.ajax({
        url:"../data_insertion/ajax_insert_auto_membership_info.php",
        type:"POST",
        data:{id:id},
        success:function(data){
            if(data==0){
                alert("No such data");
            }
            else{
                var arrey=$.parseJSON(data);
                document.getElementById('first_name').value=arrey.first;
                document.getElementById('last_name').value=arrey.last;
                //the today gate need not to be done in ajax but i dont know what comes to my mind and did this lol :)
                document.getElementById('date_of_peyment').value=arrey.date;
            }
            
        }
    });
}
//for showing exiry date after inputing month

function actualamountCalculation(){
    var rate=document.getElementById('rate').value;
    var sub=document.getElementById('month_peyment').value;
    var amtcalcu=Number(rate)*Number(sub);
    var actual=document.getElementById('actual_amount');
    actual.value=amtcalcu;
    
 
}
function discountamountCalculation(){
    var discount=document.getElementById('discount').value;
    var actual=document.getElementById('actual_amount').value;
    var amt=Number(actual)-Number(discount);
    var amtactual=document.getElementById('amount');
    amtactual.value=amt;
}
function submitMembershipInfo(){
    var id=document.getElementById('id').value;
    var firstName=document.getElementById('first_name').value;
    var lastName=document.getElementById('last_name').value;
    var dop=document.getElementById('date_of_peyment').value;
    var am=document.getElementById('actual_amount').value;
    var dg=document.getElementById('discount').value;
    var amt=document.getElementById('amount').value;
    var doe=document.getElementById('date_of_expiry').value;
    // var fullPath = document.getElementById('templete').value;

    // if (fullPath) {
    //     var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
    //     var filename = fullPath.substring(startIndex);
    //     if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
    //         filename = filename.substring(1);
    //     }
    //     var filenamee=filename;
    // }
    $.ajax({
        url:"../data_insertion/ajax_insert_membership_info.php",
        type:"POST",
        data:{id:id,first_name:firstName,last_name:lastName,date_of_peyment:dop,actual_amount:am,discount:dg,amount:amt,date_of_expiry:doe},
        success:function(data){
            if(data==0){
                alert("Data inserted");
            }
            else{
                alert("Data not inserted");
            }
        }
    });
}
function submitMembershiptemp(){
    var fileInput = document.getElementById('fileInput');
    var file = fileInput.files[0];
    var formData = new FormData();
    formData.append('file', file);
    $.ajax({
        url:"../data_insertion/ajax_insert_membership_info.php",
        type:"POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success:function(data){

        }
    });
}