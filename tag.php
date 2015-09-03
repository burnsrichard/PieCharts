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

        try {
            // Create connection
            $dbh = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

		// From the link, get which tag was clicked
		$tag = filter_input(INPUT_GET, 'id');
		?>
        
        <div id="tags">
            <?php
                $stmt = $dbh->query("SELECT * FROM `TagDefinitions` WHERE `tag` LIKE '".$tag."'");
                $stmt->execute();
                $row = $stmt->fetch();
                echo $tag . " : ";
                echo $row["definition"];
            ?>
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
		$sql = "SELECT * FROM `Corpus` WHERE `tags` LIKE '%".$tag."%'";
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

</body>
</html>