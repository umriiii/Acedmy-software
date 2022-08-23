$(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
      $(document).on('click', '.edit_data', function(){  
           var employee_id = $(this).attr("id");  
           $.ajax({  
                url:"class/ajax_sql_students/fetch.php",  
                method:"POST",  
                data:{employee_id:employee_id},  
                dataType:"json",  
                success:function(data){  
                     $('#stu_name').val(data.stu_first_name);  
                     $('#fat_name').val(data.stu_last_name);
                     $('#stu_reg').val(data.stu_reg_no);
                     $('#birthday').val(data.birthday);  
                     $('#gender').val(data.sex); 
                     $('#religion').val(data.religion);
                     $('#blood').val(data.blood_group);  
                     $('#address').val(data.address);  
                     $('#phone').val(data.phone);  
                     $('#stu_class').val(data.class_name);  
                     $('#mot_name').val(data.mother_name);  
                     $('#create_on').val(data.create_on);  
                     $('#employee_id').val(data.studentid);  
                     $('#insert').val("Update");  
                     $('#add_data_Modal').modal('show');  
                }  
           });  
      });  
      $('#insert_form').on("submit", function(event){ 


    var stu_class=$('#stu_class').val();
     /*$.ajax({
        url: 'class/ajax_sql_students/insert.php',
        method: 'POST',
        data: {
          "class_id": stu_class
          
        },
        success:function(data){
           $('.no').hide();
           $('#employee_table').html(data); 
        
        }
     });*/
    






           event.preventDefault();  
  //          if($('#f_name').val() == "")  
  // {  
  //  alert("First name is required");  
  // }  
  // else if($('#l_name').val() == '')  
  // {  
  //  alert("Last name is required");  
  // }  
  // else if($('#birthday').val() == '')
  // {  
  //  alert("Birthday is required");  
  // }
  // else if($('#gender').val() == '')
  // {  
  //  alert("Gender is required");  
  // }
  // else if($('#religion').val() == '')
  // {  
  //  alert("religion is required");  
  // }
  // else if($('#blood').val() == '')
  // {  
  //  alert("Blood group is required");  
  // }
  //  else if($('#address').val() == '')
  // {  
  //  alert("Address is required");  
  // }
  //  else if($('#phone').val() == '')
  // {  
  //  alert("Phone number is required");  
  // }
  //          else  
  //          { 
  // zaid bhai send this class_id on my request but there is no need of this 
                $('#insert_form').append("<input type='hidden' name='class_id' value='" + stu_class + "'/>");
                $.ajax({  
                     url:"class/ajax_sql_students/insert.php",  
                     method:"POST",  
                     data:$('#insert_form').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("Inserting");  
                     },  
                     success:function(data){  
                          $('#insert_form')[0].reset();  
                          $('#add_data_Modal').modal('hide');  
                          $('#employee_table').html(data);  
                     }  
                });  
           // }  
      });  
      $(document).on('click', '.view_data', function(){  
           var employee_id = $(this).attr("id");  
           if(employee_id != '')  
           {  
                $.ajax({  
                     url:"class/ajax_sql_students/select.php",  
                     method:"POST",  
                     data:{employee_id:employee_id},  
                     success:function(data){  
                          $('#employee_detail').html(data);  
                          $('#dataModal').modal('show');  
                     }  
                });  
           }            
      });  
 });  

     $(document).on('click', '.idcard_data', function(){  
           var employee_id = $(this).attr("id");  
            
             
                $.ajax({  
                     url:"class/ajax_sql_students/select_idcard.php",  
                     method:"POST",  
                     data:{employee_id:employee_id},  
                     success:function(data){  
                          $('#idcard_details').html(data);  
                          $('#idcard_modal').modal('show');  
                     }  
                });  
                      
      });
 
     $(document).on('click', '.gen_id_card', function(){  
           var employee_id = $(this).attr("id");  
                $.ajax({  
                     url:"class/ajax_sql_students/select_idcard.php",  
                     method:"POST",  
                     data:{employee_id:employee_id}  
                     
                });  
                      
      });



    $(document).on('click', '.btn_delete', function(){  
           // var id=$(this).data("id3");
            var el = this;
        var id = this.id;
        var splitid = id.split("_");

        // Delete id
        var deleteid = splitid[1];  
           if(confirm("Are you sure you want to delete this?"))  
           {  
                $.ajax({  
                     url:"class/ajax_sql_students/delete.php",  
                     method:"POST",  
                     data:{id:id},  
                     dataType:"text",  
                     success:function(data){  
                           $(el).closest('tr').css('background','#d31027');
                $(el).closest('tr').fadeOut(800, function(){      
                    $(this).remove();
                });  
                            
                     }  
                });  
           }  
      }); 