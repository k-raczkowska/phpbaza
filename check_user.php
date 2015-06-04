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
if (isset($_GET['login']) && isset($_GET['haslo'])) {
 
    $login2 = $_GET['login'];
	$haslo2 = $_GET['haslo'];
 
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
	
	if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
	$result2 = mysql_query("SELECT * FROM uzytkownik WHERE login = $login2 and haslo = $haslo2 ") or die('zapytanie :'.$sql.' blad:'.mysql_error());
		if(mysql_num_rows($result2) > 0){
			//echo 'poprawnie';
	
	
		$response["uzytkownik"] = array();
 
		while ($row = mysql_fetch_array($result)) {
			// temp user array
			$cwiczenia_uzytkownika = array();
			$cwiczenia_uzytkownika["id"] = $row["id"];
			// push single product into final response array
			array_push($response["uzytkownik"], $cwiczenia_uzytkownika);
		}
		// success
		$response["success"] = 1;
 
		// echoing JSON response
		echo json_encode($response);
		} else {
			$response["success"] = -1;
			$response["message"] = "Wrong password";
			echo json_encode($response);
		}
	} else{
		$response["success"] = -2;
		$response["message"] = "No user";
		echo json_encode($response);
	}
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No products found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>