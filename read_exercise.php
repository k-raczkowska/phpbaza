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
if (isset($_GET['userID'])) {
 
    $userID = $_GET['userID'];
 
    // mysql update row with matched pid
    $result = mysql_query("SELECT c.id_cwiczenia, c.id, nazwa, c.czy_wykonane FROM cwiczenie_uzytkownika c JOIN d_cwiczenie d ON d.id = c.id_cwiczenia WHERE id_uzytkownika = $userID AND data_wykonania = current_date ");
 
    
	if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["cwiczenie_uzytkownika"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $cwiczenia_uzytkownika = array();
		$cwiczenia_uzytkownika["id_cwiczenia"] = $row["id_cwiczenia"];
        $cwiczenia_uzytkownika["id"] = $row["id"];
		$cwiczenia_uzytkownika["nazwa"] = $row["nazwa"];
		$cwiczenia_uzytkownika["czy_wykonane"] = $row["czy_wykonane"];
        // push single product into final response array
        array_push($response["cwiczenie_uzytkownika"], $cwiczenia_uzytkownika);
    }
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
	} else{
    // no products found
		$response["success"] = -1;
		$response["message"] = "No exercises found";
		echo json_encode($response);
	}
} else {
    $response["success"] = 0;
    $response["message"] = "GET not set";
 
    // echo no users JSON
    echo json_encode($response);
}
?>