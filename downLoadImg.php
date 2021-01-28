<?php
session_start();
//header("location:listaRegisto.php");

include_once("PDO/info/db.php");

$URL = $_POST['urlImg'];


if($URL == "")
{
    header("location:listaRegisto.php");
    $_SESSION["sucesso"] = false;
    $_SESSION["mensagem"] = "Imagem vazia!";
    
    die();
}
//verificação se o email que se pretende registar já está inserido na base de dados
$stmt = $conn->prepare("SELECT COUNT(*) AS total FROM tmyimgs WHERE urlImg = :url");
$stmt->bindParam(":url",$URL);
$stmt->execute();
$result = $stmt->fetch();

if($result["total"]>0)
{
    header("location:listaRegisto.php");
    $_SESSION["sucesso"] = false;
    $_SESSION["mensagem"] = "Esta imagem já se encontra registada!";

    die();
}

$data=date("Y/m/d"); 
$idUser=$_SESSION["user"]["id"];

//Inserção da informação relativa ao novo utilizador
$stmt = $conn->prepare("INSERT INTO tmyimgs(urlImg,dataInserir,idUser) VALUES(:url,:data,:idUser);");
$stmt->bindParam(":url",$URL);
$stmt->bindParam(":data",$data);
$stmt->bindParam(":idUser",$idUser);
$stmt->execute();

if($stmt=true){
    $_SESSION["mensagem"] ="Registo Efetuado!";
    header("location:listaRegisto.php");
}

?>