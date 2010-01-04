<?php // login.php - created 11/01 for IT313 by Joshua Priddle
session_start(); // Start session

// Connect to MySQL

$con = mysql_connect('localhost', 'priddle_itt', '1ttsux0rs');
mysql_select_db('priddle_nevercraft');

// Select the username and password from MySQL
$sql = "SELECT username, password FROM it313_auth_users WHERE username = '".
		mysql_escape_string( $_POST['username'] ) . "'";

// Execute the query
$res = @mysql_query( $sql );

if ( mysql_num_rows( $res ) == 0 ) { // If the username isnt int he db
	// Fire an error and exit
	//trigger_error('Invalid username!');
	//exit();

	header( "Location: index.php?error=username" );
} else { // The username is in the db
	if ( !$row = mysql_fetch_assoc( $res ) ) { // if we CANT select the data
		// fire an error and exit
		//trigger_error('Error retrieving data!');
		//exit();

		header("Location: index.php?error=data");
	} else { // if we CAN select the data
		if ( $row['password'] == $_POST['encrypted_pw'] ) {		// if the passwords match...
			$_SESSION['username'] = $row['username']; 			// create the username session var
		} else {
			//trigger_error('Incorrect password!');
			//exit();
			//echo "Wrong!";
			//header("Location: index.php?error=password");

			// The password is INVALID
			$invalid_pw = 'YES'; 
		}
		// and redirect to the main page
		if ( $invalid_pw != 'YES' ) { // If the password is valid
			header("Location: index.php" . ( ( $_POST['random'] == 'Y'  ) ? '?rand' : ''  ) );
			// if the user wants to randomize, do it..
		} else { // invalid password
			header( "Location: index.php?error=password" );
		}
	}
}

?>
