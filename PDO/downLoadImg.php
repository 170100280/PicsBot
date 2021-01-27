<?php
session_start();
header("location:../myFile.php");

include_once("info/db.php");

$URL = $_POST["mail"];// recolher o url da imagem

if($URL == "")
{
    header("location:../myFile.php");
    $_SESSION["sucesso"] = false;
    $_SESSION["mensagem"] = "Imagem vazia!";
    die();
}
//verificação se o email que se pretende registar já está inserido na base de dados
$stmt = $conn->prepare("SELECT COUNT(*) AS total FROM tusers WHERE urlImg = :url");
$stmt->bindParam(":url",$URL);
$stmt->execute();
$result = $stmt->fetch();

if($result["total"]>0)
{
    header("location:../myFile.php");
    $_SESSION["sucesso"] = false;
    $_SESSION["mensagem"] = "Esta imagem já se encontra registada!";
    die();
}

//$data=; escrever data atual
//$idUser=; recolher id do user atual


//Inserção da informação relativa ao novo utilizador
$stmt = $conn->prepare("INSERT INTO tusers(urlImg,dataInserir,idUser) VALUES(:url,:data,:idUser);");
$stmt->bindParam(":url",$URL);
$stmt->bindParam(":data",$data);
$stmt->bindParam(":idUser",$idUser);
$stmt->execute();

?>