<?php
 
/*
 * Following code will list all the products
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// get all products from products table
$result = mysql_query("SELECT cwiczenie_uzytkownika.id, d_cwiczenie.nazwa, cwiczenie_uzytkownika.czy_wykonane FROM cwiczenie_uzytkownika INNER JOIN d_cwiczenie ON cwiczenie_uzytkownika.id_cwiczenia = d_cwiczenie.id where data_wykonania = current_date ") or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["cwiczenie_uzytkownika"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $cwiczenia = array();
		$cwiczenia["id"] = $row["id"];
        $cwiczenia["nazwa"] = $row["nazwa"];
		$cwiczenia["czy_wykonane"] = $row["czy_wykonane"];
        // push single product into final response array
        array_push($response["cwiczenie_uzytkownika"], $cwiczenia);
    }
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No products found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>