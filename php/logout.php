<?php
header('Content-Type: text/html; charset=utf-8');
header('Cache-Control: must-revalidate, pre-check=0, no-store, no-cache, max-age=0, post-check=0');

  // Funktion zum Ausloggen
    function logout(){
      session_destroy();
      header('location: index.php'); // Hier muss das richtige Ziel nach dem Auslogen angegeben werden.
    }

?>