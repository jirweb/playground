<?php
header('Content-Type: text/html; charset=utf-8');
header('Cache-Control: must-revalidate, pre-check=0, no-store, no-cache, max-age=0, post-check=0');

	// Funktion die prüft ob ein login stttgefunden hat.
	function session(){
		session_start();
  		if (!isset($_SESSION['Nr'])) {
    		header('Location: ./index.php'); // Hier muss das richtige Ziel stehen, wenn es keinen login gab.
    	exit();
  		}

  		$SessionNr = $_SESSION['Nr'];
  		return $SessionNr;
  	}
?>