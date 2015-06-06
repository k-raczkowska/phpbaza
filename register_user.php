<?php
 
/*
 * Following code will update a product information
 * A product is identified by product id (pid)
 */
 
// array for JSON response
$response = array();
 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
 
    // connecting to db
    $db = new DB_CONNECT();
	
// check for required fields
if (isset($_POST['login']) && isset($_POST['haslo']) && isset($_POST['pozycja'])) {
 
    $login2 = $_POST['login'];
	$haslo2 = $_POST['haslo'];
	$pozycja2 = $_POST['pozycja'];
 
    // mysql update row with matched pid
    /*$result = mysql_query("
	SET TRANSACTION ISOLATION LEVEL SERIALIZABLE
	BEGIN TRANSACTION
    DECLARE @id AS INT
    SELECT @id = id FROM uzytkownik WHERE login=@login2
    IF @id IS NULL
    BEGIN
		SELECT haslo FROM uzytkownik WHERE login = @login2
		
    END
    SELECT @id
	COMMIT TRANSACTION
	");
	echo 'sss';
	echo $result;
    */
	$result = mysql_query("SELECT * FROM uzytkownik WHERE login = $login2 ") or die('zapytanie :'.$sql.' blad:'.mysql_error());
	
	/*$result = mysql_query("SELECT * FROM uzytkownik WHERE login = $login2 and haslo = $haslo2 ") or die('zapytanie :'.$sql.' blad:'.mysql_error());*/
	
	if (mysql_num_rows($result) <= 0) {
    // looping through all results
    // products node
		$result2 = mysql_query("INSERT INTO uzytkownik(login, haslo, pozycja) VALUES($login2, $haslo2, $pozycja2)");
			if ($result2) {
				// successfully inserted into database
				$response["success"] = 1;
				$response["message"] = "Sukces";
	 
				// echoing JSON response
				echo json_encode($response);
			} else {
				// failed to insert row
				$response["success"] = 0;
				$response["message"] = "Failed to insert";
		 
				// echoing JSON response
				echo json_encode($response);
			}
	} else{
		$response["success"] = -1;
		$response["message"] = "User already exists";
		echo json_encode($response);
	}
} else {
    // required field is missing
    $response["success"] = -2;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>