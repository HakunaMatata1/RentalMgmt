<?php
//db info
include("config.php");

//Connects to database
$db = new mysqli($db_server, $db_user, $db_password,$db_name,$db_port);
if (!$db) 
	die("Could not connect! ".mysqli_error());
else
    print("Successfully connected! Yippee! ");    
//post for dates from date picker
$date3 = $_POST['date3'];
$date4 = $_POST['date4'];

//post for street address
$house = $_POST['house'];

//post for expense categories and setting escape chars for query
$expense = $_POST['expense'];
$expense_array = "'".implode("', '", $expense)."'"; //makes format 'hi', 'there', 'everybody'

//finds all the expense table info, when user picked the categories, house, and date
$query = "SELECT a1.expense_id, a1.expense, a1.expense_amount, a1.expense_date, a1.expense_description, b1.address_street   
          FROM expense AS a1
          INNER JOIN house AS b1
          ON a1.house_id = b1.house_id
          WHERE (a1.expense IN ($expense_array)) 
            AND b1.address_street = '$house' 
            AND (a1.expense_date BETWEEN '$date3' AND '$date4')    
          ";

//finds the total amount and the number of items in the query
$query2 = "SELECT SUM(a1.expense_amount), COUNT(expense_id)   
          FROM expense AS a1
          INNER JOIN house AS b1
          ON a1.house_id = b1.house_id
          WHERE (a1.expense IN ($expense_array)) 
            AND b1.address_street = '$house' 
            AND (a1.expense_date BETWEEN '$date3' AND '$date4') 
            ";
$result = $db->query($query);




?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
    <?php
    
   while ($row = $result->fetch_array(MYSQLI_ASSOC))
   {
   printf ("<br>ID: %s House: %s Expense Type: %s Amount: $%s Date: %s Description:%s <br>",$row["expense_id"],$row["address_street"],$row["expense"],$row["expense_amount"],$row["expense_date"],$row["expense_description"]);
   //print ("<option value='$row[address_street]'>$row[address_street]</option>\n");
   }
  
   $result->free();     
   
   //gets 2nd query into result
   $result = $db->query($query2);
   
   //grabs NUM array
   $sum = $result->fetch_array(MYSQLI_NUM);
   
   //prints float of total amount with total items
   printf ("<br>Total Amount: $%.2f Total Items:%s", $sum[0], $sum[1]);
   $result->free();

    
    $db->close();
    ?>    
    </body>
</html>
