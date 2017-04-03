<html>
<head>
<title>Add Income</title>
</head>
<body>

<?php

if(isset($_POST['submit'])){

	$data_missing = array();

  	if(empty($_POST['pay_date'])){
        // Adds name to array
        $data_missing[] = 'pay_date';
    } else {
        // Trim white space from the name and store the name
        $f_paydate = trim($_POST['pay_date']);
    }
    
 	if(empty($_POST['amount'])){
        // Adds name to array
        $data_missing[] = 'amount';
    } else {
        // Trim white space from the name and store the name
        $f_amount = trim($_POST['amount']);
    }
  
 	if(empty($_POST['apartments_apartment_id'])){
        // Adds name to array
        $data_missing[] = 'apartments_apartment_id';
    } else {
        // Trim white space from the name and store the name
        $f_apartments_apartment_id = trim($_POST['apartments_apartment_id']);
    }
       
    if(empty($data_missing)){
    
 //		require_once('./mysqli_connect.php');
		DEFINE ('DB_USER', 'root');
		DEFINE ('DB_PASSWORD', 'admin');
		DEFINE ('DB_HOST', 'localhost');
		DEFINE ('DB_NAME', 'patrickrealestate');
		$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
		OR die('Could not connect to MySQL: ' .
		mysqli_connect_error());
	
 		$query = "INSERT INTO `patrickrealestate`.`income` (`pay_date`, `amount`, `apartments_apartment_id`) 
			VALUES (?, ?, ?)";
	
		$stmt = mysqli_prepare($dbc, $query);

//		i Integers
//	    d Doubles
//      b Blobs
//      s Everything Else
		
		mysqli_stmt_bind_param($stmt,  "sii", $f_paydate, $f_amount, $f_apartments_apartment_id);
        
        mysqli_stmt_execute($stmt);
        
        $affected_rows = mysqli_stmt_affected_rows($stmt);
        
        if($affected_rows == 1){
            echo 'Income Entered';
            mysqli_stmt_close($stmt);
            mysqli_close($dbc);
        } else {
            echo 'Error Occurred<br />';
            echo mysqli_error();
            mysqli_stmt_close($stmt);
            mysqli_close($dbc);
        }
    } else {
        echo 'You need to enter the following data<br />';
        foreach($data_missing as $missing){
            echo "$missing<br />";
        }
    }
}
?>

<p> <font size="6">**** Add Income **** </font></p>
<form action="http://localhost/addincome.php" method="post">
<p>Payment Date (YYYY-MM-DD):
<input type="text" name="pay_date" size="10" value="" />
</p>
<p>Amount:
<input type="text" name="amount" size="5" value="" />
</p>
<p>Apartment Number:
<input type="text" name="apartments_apartment_id" size="2" value="" />
</p>
 (APT1->1, APT2->2, APT3->3, APT4->4, 93 Flinkline->5, 85 Bencon St -> 6)
<p>
<input type="submit" name="submit" value="Send" />
</p>
</form>
</body>
</html>