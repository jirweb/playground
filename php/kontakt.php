<?php
	header('Content-Type: text/html; charset=utf-8');
	header('Cache-Control: must-revalidate, pre-check=0, no-store, no-cache, max-age=0, post-check=0');

	function kontakt_form(){
		echo '<form id="kontakt" action="#" method="post">		
				<input name="name" type="text" maxlength="50" placeholder="Bitte Namen* eingeben"><br />
				<input name="mail" type="email" maxlength="50" placeholder="Bitte e-Mailadresse* eingeben"><br />
				<input name="tel" type="text" maxlength="50" placeholder="Bitte Telefonnummer eingeben"><br />
				<input name="email" type="email" class="email" maxlength="50" placeholder="Bitte e-Mailadresse bestätigen"><br />
				<textarea name="text" rows="10" placeholder="Bitte Nachricht eingeben"></textarea><br />
				<input name="senden" class="button" type="submit" value="Nachricht senden"><br />Alle Felder mit * sind Pflichtfelder.
			 </form>';

		if (isset($_POST['senden'])){
			$name = $_POST['name'];
			$mail = $_POST['mail'];
			$email = $_POST['email'];
			$text = $_POST['text'];

			// Formatierte Nachricht
			$nachricht = utf8_decode($name . " mit der e-Mail-Adresse" . $mail . "\n" . 
	    							 "hat folgende Nachricht gesendet.\n\n" .
			    					 "Nachricht:\n" . 
			    					 $text
						 );

			// Die Variablen für das Versenden der eMail
			$empfaenger =array("email_1", "email_2");
			$betreff = 'Anfrage über die Homepage';
			$header = 'From: kontakt-formular@webseite.de';
												
			if ($name == "" || $mail == "") {
				echo '<p style="text-align:center; font-weight:bold;">Bitte f&uuml;llen Sie alle Felder mit Sternchen (*) aus.</p>';
			}
			else {
				// Spam Pr&uuml;fung		
				if($email !== "") {
					// Formular wird gelöscht						
					unset($_POST);
				}
				else {
					foreach($empfaenger as $to)
					mail($to, $betreff, $nachricht, $header);
					echo '<p style="text-align:center; font-weight:bold;">Ihre Nachricht wurde versandt.</p>';
					unset($_POST);
				}
			}
		}
	}
?>