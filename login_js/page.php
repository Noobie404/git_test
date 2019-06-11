<?php 
	session_start();

	  $conn = new PDO("mysql:host=localhost;dbname=login", 'root', '');

    if($_POST["id"] != '')  {

        $id=$_POST['id'];
        $query = "SELECT * FROM `users` where id=$id";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $data=$stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($data);
    }

    else {
        $query = "SELECT * FROM `users`";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $data=$stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($data);
    }
?>