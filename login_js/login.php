<?php 
include('process.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
</head>
<body>
	<?php if(isset($_SESSION['msg'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		 ?>
	</div>
<?php endif ?>

    <select name="brand" id="brand">
        <option value="">All users</option>
        <?php echo fill_brand($db); ?>
    </select>

<!--     <div id="show">
        <?php echo fill_product($db); ?>
    </div> -->

<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	<tbody id ="show">
		
		<?php
if (isset($_SESSION['user_data'])){

	foreach ($_SESSION['user_data'] as $res) {

          	echo "<tr>
		         <td>".$res['name']."</td>
		         <td>".$res['email']." </td>
		         <td><a class='del_btn' href='login.php?delete=".$res['id']."' >Delete</a></td>
		         <td><a class='edit_btn' href='login.php?edits=".$res['id']."' >Edit</a></td>
		        
				</tr>";
		/*unset($_SESSION['user_data']);*/
          }
}
		?>
	</tbody>

</table>
<form method="post" action="process.php">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<div class="input-group">
		<label>Name</label>
		<input type="text" name="name" value="<?php echo $name ?>" placeholder="Name">
	</div>

	<div class="input-group">
		<label>Email</label>
		<input type="email" name="email" placeholder="Email" value="<?php echo $email ?>" >
	</div>
	<div class="input-group">
		<label>Password</label>
		<input type="password" name="password" placeholder="Password">
	</div>
	<div class="input-group">
		<?php if ($edit_state == false): ?>
			<button class="btn" type="submit" name="save">Save</button>
		<?php else: ?>
			<button class="btn" type="update" name="update">Update</button>
		<?php endif ?>
		
	</div>
	
</form>
</body>
</html>

 <script>
 $("#brand").change(function(){
                 var id = $(this).val(); 
                $.ajax({
                    url: 'page.php',
                    type: 'post',
                    data: {id:id},
                    dataType: 'json',
                    success:function(response){

                        var len = response.length;

                        $('#show').empty();

                            for (var i = 0; i < len; i++) {
                               var id = response[i]['id'];
                                var name = response[i]['name'];
                                var email = response[i]['email'];


                                $("#show").append('<tr><td>'+name+'</td><td>'+email+'</td><td><a class="edit_btn" href="login.php?edits='+id+'" >Edit</a></td><td><a class="del_btn" href="login.php?delete='+id+'" >Delete</a></td></tr>');

                            }

                    }
                });
            });

/*
 $(document).ready(function(){  
      $('#brand').change(function(){  
           var id = $(this).val();  
           $.ajax({  
                url:"process.php",  
                method:"POST",  
                data:{id:id}, 
                success:function(data){
                   
          //var myObj = jQuery.parseJSON(data);
           var JSONObject =JSON.stringify(data);
  console.log(JSONObject); 
//console.log(data);
         // var len =myObj.length;


              //  $('#show').html('<td>'+data+'</td>');

                     $('#show').html('<td>'+myObj.name+'</td><td>'+myObj.email+'</td><td><a class="edit_btn" href="login.php?edits='+myObj.id+'" >Edit</a></td><td><a class="del_btn" href="login.php?delete='+myObj.id+'" >Delete</a></td>');  
                }  
           });  
      });  
 });  */
 </script>