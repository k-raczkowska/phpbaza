<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['id_cwiczenia']) && isset($_POST['id_uzytkownika']) && isset($_POST['ilosc_wykonanych'])) {
 
    $id_cwiczenia = $_POST['id_cwiczenia'];
    $id_uzytkownika = $_POST['id_uzytkownika'];
	$ilosc_wykonanych = $_POST['ilosc_wykonanych'];
	
	//$response["email"] = $email;
	//$email2 = $email;
	//$imie2 = $imie;
	//$nazwisko2 = $nazwisko;
	//$haslo2 = $haslo;
	
	//$email = "jakis@mail";
	//$imie = "JakiesImie";
	//$nazwisko = "jakiesNazwisko";
	//$haslo = "haslo";
 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql inserting a new row
    $result = mysql_query("INSERT INTO `cwiczenie_uzytkownika` (`id_cwiczenia`, `id_uzytkownika`, `data_wykonania`, `ilosc_wykonanych`, `czy_wykonane`) VALUES ('$id_cwiczenia', '$id_uzytkownika', CURRENT_DATE, '$ilosc_wykonanych', '0')");
	
	//$result = mysql_query("INSERT INTO cwiczenie_uzytkownika(id_cwiczenia, id_uzytkownika, data_wykonania) VALUES (2, 2, 2015-05-24)");
	
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
    //required field is missing
	$response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>