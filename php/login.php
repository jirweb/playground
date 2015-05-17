<?php
	/*
	* Login-Modul inklusieve dem Formular. Es kann als Funktion login_form() eingebunden werden.
	* Aktuell funktioiert es mit der hinterlegten e-Mailadresse und einem Passwort
	* Es müssen ggf die Tabellen und die Spalten angepasst werden.
	*/
?>
<?php
	function login_form(){
		echo'
			<form id="login_form" name="login_form" action="#" method="post">
				<input type="text" name="email" placeholder="e-Mail-Adresse" />
				<input type="password" name="password" placeholder="Passwort" /><br />
				<input type="submit" name="anmelden" value="anmelden" />
				<input type="submit" name="pw_forgot" value="Passwort vergessen" />
				<input type="reset" name="clear" value="Alle Felder löschen" />
			</form>
		';
	}

	// Funktion zum Verbinden mit der Datenbank.
	function conect_db(){
		$con = mysql_connect('localhost', 'root', 'password'); // Hier muss der richtige Benutzername und das richtige Passwort hinterlegt werden.
		if (!$con) {
			die('Es konnte keine Verbindung ergestellt werden.' . mysql_error());
		}
		mysql_select_db('DB_NAME', $con); // Bei DB_NAME den aktuellen Namen der Datenbank eintragen.
		return $con;
	}
	
	// Abfrage in der Datenbank und Prüfung des Benutzernamen und des Passwortes
	function benutzer_u_passwort($email, $password, $con){
		$sql = mysql_query("SELECT * FROM user_tbl WHERE user_email = '$email' AND password = '$password';" ,$con);
		return $sql;
	}

	// Abfrage in der Datenbank ob die e-Mail-Adresse existiert.
	function email($email, $con){
		$sql = mysql_query("SELECT user_email FROM user_tbl WHERE user_email = '$email';" ,$con);
		return $sql;
	}

	if (isset($_POST['anmelden'])) {
		if (empty($_POST['email']) && empty($_POST['password'])) {
			echo "Bitte Benutzername und Password eingeben.";
		}
		else{

			// e-Mail und Passwort werden Übergeben.
			$email = $_POST["email"];
			$password = $_POST["password"];
			$password = md5($password);
					
			session_start();
			$con = conect_db(); // Startet die Verbindug zu Datenbank.

			$sql = benutzer_u_passwort($email, $password, $con); 
			$row = mysql_num_rows($sql);

			if ($row){
				for ($n=0; $n <= $row - 1; $n++){
					$id = mysql_result($sql, $n, 0);
					$_SESSION['Nr'] = $id;
					header('location: http://jirweb.de');
					exit();
				}
			}
			else{
				echo "<p>Error: Falsche e-Mail-Adressse und/oder das Passwort ist falsch!</p>\n ";
			}
					
				mysql_close($con);
		}
	}
	
	if (isset($_POST['pw_forgot'])){
		if (empty($_POST['email'])) {
		echo "Bitte geben Sie die e-Mail-Adressse an, mit der Sie ihre Anfrage gestartet haben.";
		}
		else{
			$email = $_POST['email'];

			$con = conect_db(); // Startet die Verbindug zu Datenbank.

			$sql = email($email, $con);
			$row = mysql_num_rows($sql);
					
			echo "Es wurden " . $row . " Ergebnisse gefunden.";
		}
	}
?>