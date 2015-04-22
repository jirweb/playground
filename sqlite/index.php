<?php
	
	// Erstellt die Datenbank
	$database = new SQLite3('user.db');

	// // Erstellt eine Tabelle
	// $sql = 'CREATE TABLE user(
	// 		userid INTEGER PRIMARY KEY,
	// 		fname TEXT,
	// 		lname TEXT,
	// 		email TEXT
	// )';
	
	// // SQL-Befehl absenden
	// $database->query($sql);

	// // Schreibt die Daten in die Tabelle
	// $sql = 	'INSERT INTO user (fname, lname, email)' .
	// 		'VALUES("Jon", "Doe", "j.doe@example.com");';

	// //SQL-Befehl absenden
	// $database->query($sql);

	// Datenbank abfragen
	$sql = "SELECT * FROM user ORDER BY lname, fname";

	// Das Ergebnis der Abfrage wird in die Variable results gespeichert
	$result = $database->query($sql);

	while ($row = $result->fetchArray()) {
		echo $row['fname'] . " " . $row['lname'] . " <br />";
		echo "Die e-Mail-Adresse ist: " . $row['email'];
		echo "<br />";
	}
?>