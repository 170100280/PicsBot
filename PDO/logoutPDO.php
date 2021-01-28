<?PHP
session_start();
header("location:../login.php");
//destruir sessão ativa
session_destroy();
die();
?>
