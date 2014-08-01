
<?php
//db info
include("config.php");
//JS calendar date picker
require_once('calendar/classes/tc_calendar.php');

//Connects to database
$db = new mysqli($db_server, $db_user, $db_password,$db_name,$db_port);
if (!$db) 
	die("Could not connect! ".mysqli_error());
else
    print("Successfully connected! Yippee! ");

//gets all the address from house table
$query = "SELECT * FROM house";

$result = $db->query($query);
?>
	

<html>
<body>
<script type="text/javascript" src="calendar/calendar.js"></script>
<form action ="query.php" method ="post">
<?php

//drop down list for houses listed by their address
print("House:");
print("<select name = house>");
while ($row = $result->fetch_array(MYSQLI_ASSOC))
{
    //printf ("%s %s %s %s %s %s <br>",$row["expense_id"],$row["house_id"],$row["expense"],$row["expense_amount"],$row["expense_date"],$row["expense_description"]);
    print ("<option value='$row[address_street]'>$row[address_street]</option>\n");
}
print ("</select>");

print ("<BR>");
//check box list for expense types
print ("<input type ='checkbox' name='expense[]' value='Advertising'>Advertising <br>");
print ("<input type ='checkbox' name='expense[]' value='Repairs'>Repairs <br>");
print ("<input type ='checkbox' name='expense[]' value='Supplies'>Supplies <br>");
print ("<input type ='checkbox' name='expense[]' value='Travel (Not Auto)'>Travel (Not Auto)<br>");
print ("<input type ='checkbox' name='expense[]' value='Cleaning/Maint'>Cleaning/Maint <br>");
print ("<input type ='checkbox' name='expense[]' value='Commissions'>Commissions <br>");
print ("<input type ='checkbox' name='expense[]' value='Insurance'>Insurance <br>");
print ("<input type ='checkbox' name='expense[]' value='Professional Fees'>Professional Fees <br>");
print ("<input type ='checkbox' name='expense[]' value='Management Fees'>Management Fees <br>");
print ("<input type ='checkbox' name='expense[]' value='Real Estate Taxes'>Real Estate Taxes <br>");
print ("<input type ='checkbox' name='expense[]' value='Other Taxes'>Other Taxes <br>");
print ("<input type ='checkbox' name='expense[]' value='Utilities'>Utilities <br>");

//date picker code, using date3 and date4 as variables
$date3_default = "2014-05-26";
$date4_default = "2014-06-01";


//code to implement the date picker function
$myCalendar = new tc_calendar("date3", true, false);
$myCalendar->setIcon("calendar/images/iconCalendar.gif");
$myCalendar->setDate(date('d', strtotime($date3_default))
      , date('m', strtotime($date3_default))
      , date('Y', strtotime($date3_default)));
$myCalendar->setPath("calendar/");
$myCalendar->setYearInterval(1970, 2020);
$myCalendar->setAlignment('left', 'bottom');
$myCalendar->setDatePair('date3', 'date4', $date4_default);
$myCalendar->writeScript();	  

$myCalendar = new tc_calendar("date4", true, false);
$myCalendar->setIcon("calendar/images/iconCalendar.gif");
$myCalendar->setDate(date('d', strtotime($date4_default))
     , date('m', strtotime($date4_default))
     , date('Y', strtotime($date4_default)));
$myCalendar->setPath("calendar/");
$myCalendar->setYearInterval(1970, 2020);
$myCalendar->setAlignment('left', 'bottom');
$myCalendar->setDatePair('date3', 'date4', $date3_default);
$myCalendar->writeScript();	  


$result->free();
$db->close();
?>

<input type="submit" value="Submit">
</form>
</body>
</html>





