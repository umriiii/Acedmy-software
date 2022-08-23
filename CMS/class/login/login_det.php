<?php 

if(isset($_POST['user_type']))
{
	$Admin = $_POST['user_type'];
	if($Admin == "Principal/Director")
	{
		?>
		  <h1 style="color: green">Principal/Director Login</h1>
             
                  <div class="form-group">
                     <label>User Name</label>
                     <input type="text" class="form-control" name="pri_name" placeholder="User Name">
                  </div>
                  <div class="form-group">
                     <label>Password</label>
                     <input type="password" class="form-control" name="pri_pass" placeholder="Password">
                  </div>
                  <button type="submit" name="login" class="btn btn-black form-control" style="color: white;border-radius: 17px;">Login</button>
              
              
		<?php  
	}
	else if($Admin == "General Manager")
	{
		?>
		 <h1 style="color: green">General Manager Login</h1>
               <form method="post">
                  <div class="form-group">
                     <label>User Name</label>
                     <input type="text" class="form-control" name="gm_name" placeholder="User Name">
                  </div>
                  <div class="form-group">
                     <label>Password</label>
                     <input type="password" class="form-control" name="gm_pass" placeholder="Password">
                  </div>
                  <button type="submit" name="login" class="btn btn-black form-control" style="color: white;border-radius: 17px;">Login</button>
              
               </form>
		<?php  
	}
   else if($Admin == "Finance Manager")
   {
      ?>
       <h1 style="color: green">Finance Manager Login</h1>
               <form method="post">
                  <div class="form-group">
                     <label>User Name</label>
                     <input type="text" class="form-control" name="fc_name" placeholder="User Name">
                  </div>
                  <div class="form-group">
                     <label>Password</label>
                     <input type="password" class="form-control" name="fc_pass" placeholder="Password">
                  </div>
                  <button type="submit" name="login" class="btn btn-black form-control" style="color: white;border-radius: 17px;">Login</button>
              
               </form>
      <?php  
   }

}


 ?>
