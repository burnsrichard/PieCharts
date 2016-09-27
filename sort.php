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
        <th>Richard</th>
		<th>Eric</th>
		<th>Wiktoria</th>
		<th>Tyler</th>
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
	
	
	//$lowerlimit = 0;
	//$upperlimit = 10;
	//$sql = "SELECT * FROM `Annotations` ORDER BY Pie_Id ASC LIMIT '{$lowerlimit}', '{$upperlimit}'";
	//$result=$dbh->query($sql);
	//$resultarray = $result->fetchAll();

	$key = array('0.0' => array('','', '', '', ''));
	$letters = array(
		'A' => .01,'B' => .02,'C' => .03,'D' => .04,'E' => .05,
		'F' => .06,'G' => .07,'H' => .08,'I' => .09,'J' => .10,
		'K' => .11,'L' => .12,'M' => .13,'N' => .14,'O' => .15,
		'P' => .16,'Q' => .17,'R' => .18,'S' => .19,'T' => .20,
		'U' => .21,'V' => .22,'W' => .23,'X' => .24,'Y' => .25,
		'Z' => .26		
		);
	$sql = "SELECT * FROM `Annotations` ORDER BY Pie_Id ASC"; 
	//LIMIT 0, 10";
	
	$result=$dbh->query($sql);
	$resultarray = $result->fetchAll();

	foreach($dbh->query($sql) as $row)
	{
		foreach($resultarray as &$unsorted)
		{

			if(preg_match("/^P([0-9]+)$/i", $unsorted["Pie_Id"], $matches))
			{	
				$double = ($matches[1] + 0.0);

			}
			elseif(preg_match("/^P([0-9]+)-([0-9]+)$/", $unsorted["Pie_Id"], $matches))
			{			
				
				$temp = $matches[1] + .01 * $matches[2];
				$double = number_format($temp, 2);

			}			
			elseif(preg_match("/^P([0-9]+)-([A-Z])$/", $unsorted["Pie_Id"], $matches))
			{
	
				$temp = $matches[1] + $letters[$matches[2]];
				$double = number_format($temp, 2);
		
			}
			//elseif(preg_match("/^P([0-9]+)([A-Z])$/", $unsorted["Pie_Id"], $matches))
			//{
			//	$double = $matches[1][0];
			//	$double = $double + $letters[$matches[2][0]];
			//					print_r($double);
			//					print_r("  ");

			//}	
			else{}
				
			if ($unsorted["Annotator"] == "Richard") 
			{ 
				$key[$double][1] = $unsorted["Message"];
			}
			elseif ($unsorted["Annotator"] == "Eric") 
			{ 
				$key[$double][2] = $unsorted["Message"];
			}
			elseif ($unsorted["Annotator"] == "Wiktoria") 
			{ 
				$key[$double][3] = $unsorted["Message"];
			}
			elseif ($unsorted["Annotator"] == "Tyler") 
			{ 
				$key[$double][4] = $unsorted["Message"];
			}
			$key[$double][0] = $unsorted["Pie_Id"];
		}
	}

	$keycount = 0;

	ksort($key);	
	
	foreach($key as $id => $value)
	{ 

	?>
		
        <tr>
            <td><?php echo $keycount ?></td>
            <td><a href="piechart.php?id=<?php echo $row[$id][0]?>">
                <?php 
                echo $key[$id][0]; 
                ?></a>
            </td> 
			<td><?php if (isset($key[$id][1]))
				{ 
				echo $key[$id][1];
				}?>
			</td> 
			<td><?php if (isset($key[$id][2])) 
				{ 
				echo $key[$id][2];
				}?>
			</td> 
			</td>
			<td><?php if (isset($key[$id][3])) 
				{ 
				echo $key[$id][3];
				}?>
			</td>
            <td><?php if (isset($key[$id][4])) 
				{ 
				echo $key[$id][4];
				}?>
			</td>
        </tr>
		
    <?php
	
	$keycount = $keycount + 1; 
    }
	
    ?>
</table>