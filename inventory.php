<?php
	if (isset($_POST['itemName1'])) 
	{	
		//changeQuantity
		mysql_connect("hostname", "username", "password") or die(mysql_error());
		mysql_select_db("inventory") or die(mysql_error());
		
		//update quantity
		$result = mysql_query("UPDATE Items SET quantity='$_POST[quantity1]' WHERE itemName='$_POST[itemName1]'") 
		or die(mysql_error());  
	}
?>

<?php
	if (isset($_POST['itemName1'])) 
	{
		//changePrice
		mysql_connect("hostname", "username", "password") or die(mysql_error());
		mysql_select_db("inventory") or die(mysql_error());
		
		//update price
		$result = mysql_query("UPDATE Items SET price='$_POST[price1]' WHERE itemName='$_POST[itemName1]'") 
		or die(mysql_error());
	}  
?>

<?php

	if (isset($_POST['itemName2'])) 
	{
		//addItem
		mysql_connect("hostname", "username", "password") or die(mysql_error());
		mysql_select_db("inventory") or die(mysql_error());
		
		//add item
		$result = mysql_query("INSERT INTO Items VALUES ('$_POST[itemName2]','$_POST[quantity2]','$_POST[price2]')") 
		or die(mysql_error());  
	}
?>

<?php
	if (isset($_POST['itemName3'])) 
	{
		//delete
		mysql_connect("hostname", "username", "password") or die(mysql_error());
		mysql_select_db("inventory") or die(mysql_error());
		
		//Delete from Items
		$result = mysql_query("DELETE FROM Items WHERE itemName = '$_POST[itemName3]'") 
		or die(mysql_error());  
	}
?>



<!DOCTYPE html>
<html>
	<head>
		<title>Inventory</title>
		<link rel="stylesheet" type="text/css" href="css/main.css">
	</head>
	<body>
		<div id="header">
			<a href="inventory.php"><img height="100" width="600" src="images/Lake_Superior_State_University_Wordmark.svg.png"></a><br><br>
		</div>
		
		<div id="content">
			

			<?php
			// Make a MySQL Connection
			mysql_connect("hostname", "username", "password") or die(mysql_error());
			mysql_select_db("inventory") or die(mysql_error());
			
			//delete items
			echo "<h3>Delete Items</h3>";
			echo "<form action='$_SERVER[PHP_SELF]' method='post' accept-charset='utf-8'>";	
			$query="SELECT itemName FROM Items";												    
			/* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */
			$result = mysql_query ($query);														    
			echo "<select name=itemName3 value=''>";									    
			// printing the list box select command												    
			while($nt=mysql_fetch_array($result)){//Array or records stored in $nt				    
			echo "<option value='$nt[itemName]'>$nt[itemName]</option>";							    
			/* Option values are added by looping through the array */							    
			}																					    
			echo "</select>";// Closing of list box 
			echo "<input type='submit'/></form><br><br>";
			
			// Get all the data from the "Items" table
			$result = mysql_query("SELECT * FROM Items ORDER BY itemName") 
			or die(mysql_error());  
			
			echo "<table border='1' align='center'>";
			echo "<tr> <th>Item Name</th> <th>Quantity</th> <th>Price</th> <th>Submit</th> </tr>";
			
			//outputs extra field for input
			echo "<form action='$_SERVER[PHP_SELF]' method='post' accept-charset='utf-8'>";
			echo "<tr><td style='text-align: left;'>";
			echo "<input type='text' name='itemName2' value=''>";
			echo "</td><td style='text-align: left;'><input type='text' name='quantity2' value=''>";
			echo "</td><td style='text-align: left;'><input type='text' name='price2' value=''>";
			echo "</td><td style='text-align: left;'><input type='submit'></tr></form>";

			// keeps getting the next row until there are no more to get
			while($row = mysql_fetch_array( $result )) {
				// Print out the contents of each row into a table
				if ($row['quantity']<=1)
				{
					echo "<form action='$_SERVER[PHP_SELF]' method='post' accept-charset='utf-8'>";
					echo "<tr style='background-color: red;'><td style='text-align: left;'><input type='text' name='itemName1' value='$row[itemName]' readonly>";
					echo "</td><td style='text-align: left;'><input type='text' name='quantity1' value='$row[quantity]'>";
					echo "</td><td style='text-align: left;'><input type='text' name='price1' value='$row[price]'>";
					echo "</td><td style='text-align: left;'><input type='submit'></tr></form>"; 
				}
				else
				{
					echo "<form action='$_SERVER[PHP_SELF]' method='post' accept-charset='utf-8'>";
					echo "<tr><td style='text-align: left;'><input type='text' name='itemName1' value='$row[itemName]' readonly>";
					echo "</td><td style='text-align: left;'><input type='text' name='quantity1' value='$row[quantity]'>";
					echo "</td><td style='text-align: left;'><input type='text' name='price1' value='$row[price]'>";
					echo "</td><td style='text-align: left;'><input type='submit'></tr></form>"; 
				}	
			}
			echo "</table>";
			?>	
		</div>
	</body>
</html>
