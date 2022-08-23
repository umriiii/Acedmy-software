$(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
      $(document).on('click', '.edit_data', function(){  
           var employee_id = $(this).attr("id");  
           $.ajax({  
                url:"class/ajax_sql_classes/fetch.php",  
                method:"POST",  
                data:{employee_id:employee_id},  
                dataType:"json",  
                success:function(data){  
                     $('#name').val(data.class_name);  
                     $('#c_teacher').val(data.teacher_id);    
                     $('#employee_id').val(data.classid);  
                     $('#insert').val("Update");  
                     $('#add_data_Modal').modal('show');  
                }  
           });  
      });  
      $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
           if($('#f_name').val() == "")  
  {  
   alert("First name is required");  
  }  
  else if($('#l_name').val() == '')  
  {  
   alert("Last name is required");  
  }  
  else if($('#birthday').val() == '')
  {  
   alert("Birthday is required");  
  }
  else if($('#gender').val() == '')
  {  
   alert("Gender is required");  
  }
  else if($('#religion').val() == '')
  {  
   alert("religion is required");  
  }
  else if($('#blood').val() == '')
  {  
   alert("Blood group is required");  
  }
   else if($('#address').val() == '')
  {  
   alert("Address is required");  
  }
   else if($('#phone').val() == '')
  {  
   alert("Phone number is required");  
  }
           else  
           {  
                $.ajax({  
                     url:"class/ajax_sql_classes/insert.php",  
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
           }  
      });  
      $(document).on('click', '.view_data', function(){  
           var employee_id = $(this).attr("id");  
           if(employee_id != '')  
           {  
                $.ajax({  
                     url:"class/ajax_sql_classes/select.php",  
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
                     url:"class/ajax_sql_classes/delete.php",  
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