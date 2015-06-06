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
if (isset($_GET['pozycja'])) {
 
	$id_pozycji = $_GET['pozycja'];
 
    // mysql update row with matched pid
    $result = mysql_query("SELECT id_cwiczenia FROM d_cwiczenia_pozycji WHERE id_pozycji = $id_pozycji ");
	//echo mysql_num_rows($result);
    
	if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["cwiczenie_pozycji"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $cwiczenia_pozycji = array();
        $cwiczenia_pozycji["id_cwiczenia"] = $row["id_cwiczenia"];
        // push single product into final response array
        array_push($response["cwiczenie_pozycji"], $cwiczenia_pozycji);
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