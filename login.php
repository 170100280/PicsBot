<?PHP
session_start();
?>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
  <form method="POST" action="PDO/loginPDO.php">
    <input type="email" name="mail" placeholder="Email"/>
    <input type="password" name="pass" placeholder="Password"/>
    <input type="submit" value="enviar"/>
    <a href="registarNovaConta.php">Registar</a>
    <span>
      <?PHP
        if(isset($_SESSION["sucesso"]))
        {
          if($_SESSION["sucesso"] == false)
          {
            echo $_SESSION["mensagem"];
            $_SESSION["mensagem"] = "";
          }
        }
      ?>
    </span>
  </form>
</body>
</html>
