<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>PieCharts</title>

	<link rel="stylesheet" href="style.css">
</head>
<body>
<?php

// must first forward local port to taz
// remote connections to port 3306 are blocked
// $ ssh -L 8306:localhost:3306 user@taz.cs.wcupa.edu
$host = "127.0.0.1";
$port = 8306;              // forwarded port

$dbname = "PieCharts";
$username = "";
$password = "";

// username and password re-defined in external php file
// included in .gitignore, so they're never committed into repo
require 'credentials.php';
?>
<div id="header">Pie Charts</> <br> 
                <a href="index.php">Corpus</a> | 
                <a href="groupedpies.php">Grouped Pie Charts</a> |
                <a href="messages.php">Message Categories</a>
</div>
<table>
    <tr>
        <th>Index</th>
        <th>Id</th>  
        <th>Date</th>
        <th>Headline</th>
        <th>Tags</th>
    </tr>
<?php
try {

	// Create connection
	$dbh = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
    $cnt = "SELECT COUNT(*) FROM `Corpus` WHERE `Thrown Out` = 0 OR `Thrown Out` = 2"; 
    $stmt = $dbh->prepare($cnt);
    $stmt->execute();
    $total = $stmt->fetch();
    echo "Total number of pies shown: " . $total[0];
        
	$sql = "SELECT * FROM `Corpus` WHERE `Thrown Out` = 0 OR `Thrown Out` = 2";
    foreach($dbh->query($sql) as $row) { ?>
        <tr>
            <td><?php echo $row["Index"]?></td>
            <td><a href="piechart.php?id=<?php echo $row["Id"]?>">
                <?php 
                echo $row["Id"]; 
                if($row["Thrown Out"] == 2) {
                    echo " ?";              
                }
                ?></a>
            </td> 
            <td><?php 
                    if($row["Date"] == null) {
                        echo "date unknown";
                        }else 
                        echo $row["Date"];
            ?></td>
            <td><?php echo $row["Headline"]?></td>
            <td><?php echo $row["tags"]?></td>
        </tr>
    <?php
    }
    ?>
</table>
<div id = "tags">
    Tags:
    <?php 
        //display distinct types of tags
        $tags = array();
        $tags2 = "SELECT `tags` FROM `Corpus`";
        foreach($dbh->query($tags2) as $row) {
            $components = $row["tags"];
            $seperateTags = preg_split("/( |,)/", $components);
            foreach($seperateTags as $aTag) {
                array_push($tags, $aTag);
            }
        }
        $result = array_unique($tags);
        foreach($result as $value){
            echo "<a href='tag.php?id=$value'>" . $value . "</a> ";
        }

         
    ?>
</div>
<?php
// close the connection
$dbh = null;
?>
</body>
</html>