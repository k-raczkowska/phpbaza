<?php
 
/*
 * Following code will update a product information
 * A product is identified by product id (pid)
 */
 
// array for JSON response
$response = array();
 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
 if (isset($_GET['userID'])) {

    $userID = $_GET['userID'];
 
    // connecting to db
    $db = new DB_CONNECT();
	
    // mysql update row with matched pid
    $result = mysql_query("SELECT dc.id, dc.nazwa FROM d_cwiczenie dc JOIN d_cwiczenia_pozycji dcp ON dc.id = dcp.id_cwiczenia JOIN uzytkownik usr ON usr.pozycja = dcp.id_pozycji WHERE usr.id = $userID; ");
 
    
	if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["d_cwiczenie"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $d_cwiczenie = array();
        $d_cwiczenie["id"] = $row["id"];
		$d_cwiczenie["nazwa"] = $row["nazwa"];
        // push single product into final response array
        array_push($response["d_cwiczenie"], $d_cwiczenie);
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