<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['email']) && isset($_POST['imie']) && isset($_POST['nazwisko']) && isset($_POST['haslo'])) {
 
    $email = $_POST['email'];
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
	$haslo = $_POST['haslo'];
	
	$response["email"] = $email;
	$email2 = $email;
	$imie2 = $imie;
	$nazwisko2 = $nazwisko;
	$haslo2 = $haslo;
	
	//$email = "jakis@mail";
	//$imie = "JakiesImie";
	//$nazwisko = "jakiesNazwisko";
	//$haslo = "haslo";
 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql inserting a new row
    $result = mysql_query("INSERT INTO users(email, imie, nazwisko, haslo) VALUES ('$email', '$imie', '$nazwisko', '$haslo')");
	
	//$result = mysql_query("INSERT INTO users(userID, email, imie, nazwisko, haslo) VALUES (15, 'x', //'y', 'z', 'z')");
 
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Sukces";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Niekoniecznie";
 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>