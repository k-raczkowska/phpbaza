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
    $result = mysql_query("SELECT id, id_cwiczenia, ilosc_wykonanych, data_wykonania FROM cwiczenie_uzytkownika WHERE id_uzytkownika = $userID AND czy_wykonane = 0 AND data_wykonania < CURRENT_DATE ORDER BY data_wykonania ASC ");
	//echo mysql_num_rows($result);
    
	if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["cwiczenie_uzytkownika"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $cwiczenia_uzytkownika = array();
		$cwiczenia_uzytkownika["id"] = $row["id"];
        $cwiczenia_uzytkownika["id_cwiczenia"] = $row["id_cwiczenia"];
        $cwiczenia_uzytkownika["ilosc_wykonanych"] = $row["ilosc_wykonanych"];
        // push single product into final response array
        array_push($response["cwiczenie_uzytkownika"], $cwiczenia_uzytkownika);
    }
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
	} else{
		$response["success"] = -1;
		$response["message"] = "Brak cwiczen spelniajacych kryteria";
		
		echo json_encode($response);
	}
} else {
    // no products found
    $response["success"] = -2;
    $response["message"] = "UserID not set";
 
    // echo no users JSON
    echo json_encode($response);
}
?>