<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>PieCharts</title>

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
        <th>Id</th>  
        <th>Date/time</th>
        <th>Message category</th>
        <th>Annotator</th>
    </tr>
	
<?php
try 
{
	// Create connection
	$dbh = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
} 
catch (PDOException $e) 
{
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
	$cnt = "SELECT COUNT(*) FROM `Annotations`"; 
	$stmt = $dbh->prepare($cnt);
	$stmt->execute();
	$total = $stmt->fetch();
	echo "Total number of pies shown: " . $total[0];
    
	$sql = "SELECT * FROM `Annotations`";
    foreach($dbh->query($sql) as $row) 
	{ ?>
        <tr>
            <td><?php echo $row["Index"]?></td>
            <td><a href="piechart.php?id=<?php echo $row["Id"]?>">
                <?php 
                echo $row["Pie_Id"]; 
                ?></a>
            </td> 
            <td><?php echo $row["Timestamp"];?></td>
            <td><?php echo $row["Message"]?></td>
            <td><?php echo $row["Annotator"]?></td>
        </tr>
    <?php
    }
    ?>
</table>