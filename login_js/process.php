<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'login');

function fill_brand($db)
{
    $output = '';
    $sql = "SELECT * FROM users";
    $result = mysqli_query($db, $sql);
    while($row = mysqli_fetch_array($result))
    {
        $output .= '<option value="'.$row["id"].'">'.$row["name"].'</option>';
    }
    return $output;
}


function fill_product($db)  
 {  
      $output = '';  
      $sql = "SELECT * FROM users";  
      $result = mysqli_query($db, $sql);  
      while($row = mysqli_fetch_array($result))  
      {   
           $output .= '<div style="border:1px solid #ccc; padding:20px; margin-bottom:20px;">'.$row["email"].'';  
           $output .=     '</div>';  
           $output .=     '</div>';  
      }  
      return $output;  
 } 


 if(isset($_POST["id"]))  
 {  	
 	   $output = '';  
      if($_POST["id"] != '')  
      {  
           $sql = "SELECT * FROM users WHERE id = '".$_POST["id"]."'"; 
           $result = mysqli_query($db, $sql);  
      }  
      else  
      {  
           $sql = "SELECT * FROM users";
            $result = mysqli_query($db, $sql);  
      }  
       
      while($row =mysqli_fetch_assoc($result))  
      {  

      	//$myJSON = json_encode($row);

         $someJSON = json_encode($row);
  echo $someJSON;  
      }  
      
      
 } 


// initialize variables
	$name = "";
	$email = "";
	$id = 0;
	$edit_state = false;

	if (isset($_POST['save'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		mysqli_query($db, "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password ')"); 
		$_SESSION['msg'] = "Information saved";

		 $conn = new PDO("mysql:host=localhost;dbname=login", 'root', '');
		 $query = "SELECT * FROM `users` where name='$name'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $data=$stmt->fetchAll(PDO::FETCH_ASSOC);

		$_SESSION['user_data']= $data;

		header('location: login.php');
	}
	if (isset($_POST['update'])) {
		$name =$_POST['name'];
		$email = $_POST['email'];
		$id = $_POST['id'];

		$update = mysqli_query($db, "UPDATE users SET name='$name', email='$email' WHERE id='$id'");

		if(!$update){
			echo "ERROR: Could not able to execute " . mysqli_error($db);
		}
		else{
			$_SESSION['msg'] = "Information updated";
			header('location: login.php'); 
		}
	}
	if(isset($_GET['delete'])){
		$id=$_GET['delete'];
		mysqli_query($db, "DELETE FROM users WHERE id=$id ");
		$_SESSION['msg'] = "Information deleted"; 
		header('location: login.php');
	}

	if (isset($_GET['edits'])){
		$id = $_GET['edits'];
		$edit_state = true;
		$rec = mysqli_query($db, "SELECT * FROM users WHERE id=$id");
		$record = mysqli_fetch_array($rec);
		$name = $record['name'];
		$email = $record['email'];
		$id = $record['id'];
	}
	$results = mysqli_query($db, "SELECT * FROM users");
?>