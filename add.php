<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("config.php");

if(isset($_POST['Submit'])) {	
	$name = $_POST['Pname'];
	$description = $_POST['Pdescription'];
	$price = $_POST['Pprice'];
	$quantity = $_POST['Pquantity'];
		
	// checking empty fields
	if(empty($name) || empty($description) || empty($price) || empty($quantity)) {
				
		if(empty($name)) {
			echo "<font color='red'>Product Name field is empty.</font><br/>";
		}
		
		if(empty($description)) {
			echo "<font color='red'>Product Description field is empty.</font><br/>";
		}
		
		if(empty($price)) {
			echo "<font color='red'>Product Price field is empty.</font><br/>";
		}
		if(empty($quantity)) {
			echo "<font color='red'>Product Quantity field is empty.</font><br/>";
		}
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database		
		$sql = "INSERT INTO users(Pname, Pdescription, Pprice, Pquantity) VALUES(:Pname, :Pdescription, :Pprice, :Pquantity)";
		$query = $dbConn->prepare($sql);
				
		$query->bindparam(':Pname', $name);
		$query->bindparam(':Pdescription', $description);
		$query->bindparam(':Pprice', $price);
		$query->bindparam(':Pquantity', $quantity);
		$query->execute();
		
		// Alternative to above bindparam and execute
		// $query->execute(array(':name' => $name, ':email' => $email, ':age' => $age));
		
		//display success message
		echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='index.php'>View Result</a>";
	}
}
?>
</body>
</html>
