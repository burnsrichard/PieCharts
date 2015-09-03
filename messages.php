<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Message Categories</title>

	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php
	require 'credentials.php';
	include 'header.php';
	?>

	<table>
    <tr>
        <th>Index</th>
        <th>Message Category</th>  
        <th>Definition</th>
        <th>Example</th>
    </tr>
    <?php
		try {
		// Create connection
		$dbh = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
		} catch (PDOException $e) {
    		print "Error!: " . $e->getMessage() . "<br/>";
    		die();
		}
		$sql = "SELECT * FROM `MessageCategories`";
    	foreach($dbh->query($sql) as $row) { ?>
        <tr>
            <td><?php echo $row["index"] ?></td>
            <td><?php echo $row["messageCategories"] ?></td> 
            <td><?php echo $row["message"] ?></td>
            <td><a href="piechart.php?id=<?php echo $row["example"]?>">
             	<?php echo $row["example"]; ?></a> 
            </td>
        </tr>
    <?php
    }
	?>



</body>
</html>