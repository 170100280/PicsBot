<?PHP
session_start();
?>
<html>
<head>
  <title>Registo</title>
  <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
  <form method="POST" enctype="multipart/form-data" action="PDO/registarPDO.php">
    <input type="text" name="nome" placeholder="Nome"/>
    <input type="email" name="email" placeholder="Email"/>
    <input type="password" name="pass" placeholder="Password"/>
    
    <input type="submit" value="enviar"/>
    <a href="index.php">Voltar</a>
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
