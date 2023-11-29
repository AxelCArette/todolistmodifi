<?php

session_start();

unset($_SESSION['id_user']);
unset($_SESSION['utilisateur']);
 
  header("Location: index.php");


?>