<?php
session_start();
include_once("PDO/info/db.php");

echo "entrou";

echo $_SESSION["mensagem"];



?>