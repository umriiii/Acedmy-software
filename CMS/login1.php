<?php  
ob_start();
session_start();  
 include 'classes/connection.php'; 
 $message = "";

 $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);  
      $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      if(isset($_POST["login"]))  
      {  
           if(isset($_POST["pri_name"]) || isset($_POST["pri_pass"]))  
           {  
                   
                $query = "SELECT * FROM login WHERE user_name = :username AND user_pass = :password AND type = :usertype";  
                $statement = $connect->prepare($query);  
                $statement->execute(  
                     array(  
                          'usertype'     =>     $_POST["user_type"],
                          'username'     =>     $_POST["pri_name"],  
                          'password'     =>     $_POST["pri_pass"]  
                     )  
                );  
                $count = $statement->rowCount();  
                if($count > 0)  
                {  
                     $_SESSION["principal"] = $_POST["pri_name"]; 


                     header("location: dashboard.php");  
                }  
                else  
                {  
                     $message = '';  
                }  
           } 
              if(isset($_POST["gm_name"]) || isset($_POST["gm_pass"]))  
           {  
                   
                $query = "SELECT * FROM login WHERE user_name = :username AND user_pass = :password AND type = :usertype";  
                $statement = $connect->prepare($query);  
                $statement->execute(  
                     array(  
                          'usertype'     =>     $_POST["user_type"],  
                          'username'     =>     $_POST["gm_name"],  
                          'password'     =>     $_POST["gm_pass"]  
                     )  
                );  
                $count = $statement->rowCount();  
                if($count > 0)  
                {  
                     $_SESSION["gm_manager"] = $_POST["gm_name"]; 


                     header("location:dashboard.php");  
                }  
                else  
                {  
                     $message = '';  
                }  
           } 
                if(isset($_POST["fc_name"]) || isset($_POST["fc_pass"]))  
           {  
                   
                $query = "SELECT * FROM login WHERE user_name = :username AND user_pass = :password AND type = :usertype";  
                $statement = $connect->prepare($query);  
                $statement->execute(  
                     array(  
                          'usertype'     =>     $_POST["user_type"],  
                          'username'     =>     $_POST["fc_name"],  
                          'password'     =>     $_POST["fc_pass"]  
                     )  
                );  
                $count = $statement->rowCount();  
                if($count > 0)  
                {  
                     $_SESSION["fc_manager"] = $_POST["fc_name"]; 


                     header("location:dashboard.php");  
                }  
                else  
                {  
                     $message = '';  
                }  
           }  
      }  
 
 ?>  


<title>Login</title>
<style type="text/css">
    body {
    font-family: "Lato", sans-serif;
}



.main-head{
    height: 150px;
    background: #FFF;
   
}

.sidenav {
    height: 100%;
    background-color: #000;
    overflow-x: hidden;
    padding-top: 20px;
}


.main {
    padding: 0px 10px;
}

@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
}

@media screen and (max-width: 450px) {
    .login-form{
        margin-top: 10%;
    }

    .register-form{
        margin-top: 10%;
    }
}

@media screen and (min-width: 768px){
    .main{
        margin-left: 50%; 
        margin-top: -10%;
    }

    .sidenav{
        width: 40%;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
    }

    .login-form{
        margin-top: 80%;
    }

    .register-form{
        margin-top: 20%;
    }
}


.login-main-text{
    margin-top: 20%;
    padding: 60px;
    color: #fff;
}

.login-main-text h2{
    font-weight: 300;
}

.btn-black{
    background-color: #000 !important;
    color: #fff;
}
</style>
<?php 
include 'include/header.php';
?> 
    
    <!-- Side Navbar -->
 <div class="sidenav" >
         <div class="login-main-text" style="margin-top: 150px">
            <h1>Smart College Solution </h1>
            <h2>Version (3.3.20)</h2>
            <p>An Application Based on Latest Technology to Solve College Problems. The possible solutions we have in our hand and which we can provide to run and manage an Educational Institute / chain of Educational Institute / College</p>
            <h2>Proudly Developed By  <a href="https://phtmsols.com" style="color: lightgreen">Phantom Solutions</a></h2>
             
            <h2>Drop a Messege for further Assistance.
            <br>
            <h3>Regard: Muhammad Bilal | CEO Technical Force</h3>
            </h2>
            <h5>Ph# 03028394021</h5>
         </div>
      </div>
      <div class="main">
         <div class="col-md-6 col-sm-12">
         
            <div class="login-form">
                  <form method="post">
               <label> User Type</label>
          <select class="form-control" name="user_type" id="user_type" onchange="user_type(this.value)">
            <option>--Select user Type--</option>
             <?php 
            $query="SELECT * FROM login";
             $statement = $connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            foreach($result as $row)        
            {
             ?>
            <option value="<?php echo $row['type']; ?>"><?php echo $row['type']; ?></option>
             <?php } ?>
     
          </select>
          <br>
          <div id="login_form"></div>
             </form>
             
            </div>
         </div>
      </div>
<!-- content area -->

    <!-- JavaScript files-->
  </body>
</html>
<script type="text/javascript">
 
$('#user_type').on('change', function() {
    
     var user_type=$('#user_type').val();
     // alert(sel_class);
     $.ajax({
        url: 'class/login/login_det.php',
        method: 'POST',
        data: {
          "user_type": user_type
          
        },
        success:function(data){
        
        $('#login_form').html(data);
        }
     });
    });


</script> 

