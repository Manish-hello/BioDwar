function saveFromInsertCostumerInfo(){
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
                url:"../data_insertion/ajax_insert_costumer_info.php",
                type:"POST",
                dataType:"text",
                data:{id:id,first_name:fname,last_name:lname,gender:gender,date_of_birth:dob,age:age,phone:phone,date_of_joining:doj,address:address,email:email},
                success:function(result){
                    var dataa=result;
                    alert(dataa);
                }
            });
}
    function getAge(){
        var dob = document.getElementById('date_of_birth').value;
        dob = new Date(dob);
        var today = new Date();
        var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
        document.getElementById('age').value=age;
    }

