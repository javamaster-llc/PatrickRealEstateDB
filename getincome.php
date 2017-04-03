<?php
// Get a connection for the database
//require_once('../mysqli_connect.php');
// Create a query for the database
$query = "
SELECT pay_date, amount, apartment_id, name, ssn, renting_status, sex, phone,brithdate
FROM income, tenants 
Where tenants.apartment_id = income.apartments_apartment_id
";

DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', 'admin');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'patrickrealestate');
$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
OR die('Could not connect to MySQL: ' .
		mysqli_connect_error());

// Get a response from the database by sending the connection
// and the query
$response = @mysqli_query($dbc, $query);

// If the query executed properly proceed
if($response){
	echo '<table align="left"
cellspacing="5" cellpadding="8">

<tr>
<td align="left"><b>PaymentDate</b></td>
<td align="left"><b>Amount</b></td>
<td align="left"><b>Apartment</b></td>
<td align="left"><b>Tenant Name</b></td>
<td align="left"><b>SSN</b></td>
<td align="left"><b>Renting Status</b></td>
<td align="left"><b>Sex</b></td>
<td align="left"><b>Phone</b></td>
<td align="left"><b>Birth Day</b></td>
</tr>';

	// mysqli_fetch_array will return a row of data from the query
	// until no further data is available
	while($row = mysqli_fetch_array($response)){
		echo '<tr><td align="left">' .
		$row['pay_date'] . '</td><td align="left">' .
		$row['amount'] . '</td><td align="left">' .
		$row['apartment_id'] . '</td><td align="left">' .
		$row['name'] . '</td><td align="left">' .
		$row['ssn'] . '</td><td align="left">' .
		$row['renting_status'] . '</td><td align="left">' .
		$row['sex'] . '</td><td align="left">' .
		$row['phone'] . '</td><td align="left">' .
		$row['brithdate'] . '</td><td align="left">';
		echo '</tr>';
	}
	echo '</table>';
} else {
	echo "Couldn't issue database query<br />";
	echo mysqli_error($dbc);
}
// Close connection to the database
mysqli_close($dbc);

?>
