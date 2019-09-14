<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{	
	$id = $_POST['id'];
	
	$name=$_POST['Pname'];
	$description=$_POST['Pdescription'];
	$price=$_POST['Pprice'];
	$quantity=$_POST['Pquantity'];	
	
	// checking empty fields
	if(empty($name) || empty($description) || empty($price) || empty($quantity)) {	
			
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($description)) {
			echo "<font color='red'>Description field is empty.</font><br/>";
		}
		
		if(empty($price)) {
			echo "<font color='red'>Price field is empty.</font><br/>";
		}	
		if(empty($quantity)) {
			echo "<font color='red'>Quantity field is empty.</font><br/>";
		}	
	} else {	
		//updating the table
		$sql = "UPDATE users SET Pname=:Pname, Pdescription=:Pdescription, Pprice=:Pprice, Pquantity=:Pquantity WHERE id=:id";
		$query = $dbConn->prepare($sql);
				
		$query->bindparam(':id', $id);
		$query->bindparam(':Pname', $name);
		$query->bindparam(':Pdescription', $description);
		$query->bindparam(':Pprice', $price);
		$query->bindparam(':Pquantity', $quantity);
		$query->execute();
		
		// Alternative to above bindparam and execute
		// $query->execute(array(':id' => $id, ':name' => $name, ':email' => $email, ':age' => $age));
				
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$sql = "SELECT * FROM users WHERE id=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));

while($row = $query->fetch(PDO::FETCH_ASSOC))
{
	$name = $row['Pname'];
	$description = $row['Pdescription'];
	$price = $row['Pprice'];
	$quantity = $row['Pquantity'];
}
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<a href="index.php">Home</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>Name</td>
				<td><input type="text" name="Pname" value="<?php echo $name;?>"></td>
			</tr>
			<tr> 
				<td>Description</td>
				<td><input type="text" name="Pdescription" value="<?php echo $description;?>"></td>
			</tr>
			<tr> 
				<td>Price</td>
				<td><input type="text" name="Pprice" value="<?php echo $price;?>"></td>
			</tr>
			<tr> 
				<td>Quantity</td>
				<td><input type="text" name="Pquantity" value="<?php echo $quantity;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
