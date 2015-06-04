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
if (isset($_GET['id_cwiczenia'])) {
 
	$id_cwiczenia = $_GET['id_cwiczenia'];
 
    // mysql update row with matched pid
    $result = mysql_query("SELECT ilosc_wykonanych, id_cwiczenia FROM cwiczenie_uzytkownika WHERE id = $id_cwiczenia ");
	//echo mysql_num_rows($result);
    
	if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["cwiczenie_uzytkownika"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $cwiczenia_uzytkownika = array();
        $cwiczenia_uzytkownika["ilosc_wykonanych"] = $row["ilosc_wykonanych"];
        $cwiczenia_uzytkownika["id_cwiczenia"] = $row["id_cwiczenia"];
        // push single product into final response array
        array_push($response["cwiczenie_uzytkownika"], $cwiczenia_uzytkownika);
    }
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
	} else{
		
	}
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No products found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>