<?php

	
	require 'config.php';

	if(isset($_GET['user']) && !empty($_GET['user'])){

		$parameter = $_GET['user'];

		$sql = "select * from user where id = '$parameter' limit 1";
	    $result = mysqli_query($conn, $sql);

	    if($result){

	        $count = mysqli_num_rows($result);

	        if($count > 0){

	        	while($row = mysqli_fetch_assoc($result)){

	        		$user[] = ['lastid' => $row['id'] ,'username' => $row['username'], 'latitude' => $row['latitude'], 'longitude' => $row['longitude']];
	        	}

	        	echo json_encode($user);
	        }
	    }
	}

	



?>