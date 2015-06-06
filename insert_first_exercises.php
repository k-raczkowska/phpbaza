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
if (isset($_POST['cwiczenia']) && isset($_POST['login'])) {
 
    $cwiczenia_tab = $_POST['cwiczenia'];
	$login = $_POST['login'];
	$id_uzytkownika = -1;
	
	$result = mysql_query("SELECT id FROM uzytkownik WHERE login = '$login' ");
//	or die('zapytanie :'.$sql.' blad:'.mysql_error());
	
	if ($result) {
		$interval = -1;
		$czySpec = -1;
    // looping through all results
    // products node
		$rows = mysql_fetch_row($result);
		$id_uzytkownika = $rows[0];
		if(is_array($cwiczenia_tab)){
		foreach($cwiczenia_tab as $id_cwiczenie) {
			$result2 = mysql_query("SELECT czySpecjalistyczne FROM d_cwiczenie WHERE id = $id_cwiczenie");
			$rows2 = mysql_fetch_row($result2);
			$czySpec = $rows2[0];
			if($czySpec == 1){
				$result3 = mysql_query("INSERT INTO cwiczenie_uzytkownika(id_cwiczenia, id_uzytkownika, data_wykonania, ilosc_do_wykonania, odleglosc, id_strony) VALUES($id_cwiczenie, $id_uzytkownika, current_date, 30, 5, 1)");
			}
			else
				$result3 = mysql_query("INSERT INTO cwiczenie_uzytkownika(id_cwiczenia, id_uzytkownika, data_wykonania) VALUES($id_cwiczenie, $id_uzytkownika, current_date)");
			if ($result3) {
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
		}
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