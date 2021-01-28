<?PHP
session_start();
include("info/db.php");
header("location:../myFile.php");

$email = $_POST["mail"];
$password = $_POST["pass"];

//Verificar se o email e a password estão vazias
if($email == "" || $password == "")
{
    header("location:../login.php");
    $_SESSION["sucesso"] = false;
    $_SESSION["mensagem"] = "Informação incompleta!";
    die();
}

//Consulta a BD para verificar login
$prep = $conn->prepare("SELECT password FROM tusers WHERE email = :mail");
$prep->bindParam(":mail", $email);
$prep->execute();
$resultado = $prep->fetch();

if($resultado["password"] == false)
{
  header("location:../login.php");
  $_SESSION["sucesso"] = false;
  $_SESSION["mensagem"] = "Utilizador não registado!";
  die();
}

if(!password_verify($password,$resultado["password"]))
{
  header("location:../login.php");
  $_SESSION["sucesso"] = false;
  $_SESSION["mensagem"] = "Password errada!";
  die();
}
else
{
    //Consulta a BD para efetuar login
  $stmt = $conn->prepare("SELECT * FROM tusers WHERE email = :mail");
  $stmt->bindParam(":mail",$email);
  $stmt->execute();
  $perfil = $stmt->fetch();

  $_SESSION["user"]["id"] = $perfil["_id"];
  $_SESSION["user"]["nome"] = $perfil["nome"];
  $_SESSION["user"]["email"] = $email;
 
  
}
?>
