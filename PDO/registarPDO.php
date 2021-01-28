<?PHP
session_start();
header("location:../login.php");
//inclui o ficheiro db.php neste script de forma a permitir aceder
//ao seu conteúdo, mais especificamente a ligação PDO lá criada
include_once("info/db.php");

//verifica se o elemento 'nome' existe no objecto POST
if(!isset($_POST["nome"]))
{
  header("location:../registarNovaConta.php");
  $_SESSION["sucesso"] = false;
  $_SESSION["mensagem"] = "Não autorizado!";
  //não existindo termina o script e devolve uma mensagem
  die();
}

//criação de variáveis e obtenção do valor associado no POST
$nome = $_POST["nome"];
$email = $_POST["email"];
$pass = $_POST["pass"];

if($nome == "" || $email == "" || $pass == "")
{
  header("location:../registarNovaConta.php");
  $_SESSION["sucesso"] = false;
  $_SESSION["mensagem"] = "Informação incompleta!";
  die();
}

//verificação se o email que se pretende registar já está inserido na base de dados
$stmt = $conn->prepare("SELECT COUNT(*) AS total FROM utilizadores WHERE email = :mail");
$stmt->bindParam(":mail",$email);
$stmt->execute();
$result = $stmt->fetch();

if($result["total"]>0)
{
  header("location:../registarNovaConta.php");
  $_SESSION["sucesso"] = false; 
  $_SESSION["mensagem"] = "Utilizador já registado!";
  die();
}

$passwordHash = password_hash($pass,PASSWORD_DEFAULT);

//Inserção da informação relativa ao novo utilizador
$stmt = $conn->prepare("INSERT INTO tusers(nome,email,password) VALUES(:nome,:mail,:pass);");
$stmt->bindParam(":nome",$nome);
$stmt->bindParam(":mail",$email);
$stmt->bindParam(":pass",$passwordHash);
$stmt->execute();
?>
