<?PHP
session_start();
include ("../imgBD.php");

class login{

  //header("location:../profile.php");

  const PROJFOLDER = '/programacao_para_web/21032018';
  private $mEmail, $mPassword;
  private $mPrep,$mConn, $mResult;

  public function __construct()
  {
      $this->mEmail = $_POST["mail"];
      $this->mPassword = $_POST["pass"];

      if ($this->mEmail == "" || $this->mPassword == "")
      {
        header("location:../index.php");
        $_SESSION["sucesso"] = false;
        $_SESSION["mensagem"] = "Informação incompleta!";
        die();
      }
  }//__construct


  public function efetuarLogin(){

    $this->mPrep = $this->conn->prepare("SELECT password FROM utilizadores WHERE email = :mail");
    $this->mPrep->bindParam(":mail", $this->mEmail);
    $this->mPrep->execute();
    $this->mResult = $this->mPrep->fetch();


    if ($this->mResult["password"] == false) {
      header("location:../index.php");
      $_SESSION["sucesso"] = false;
      $_SESSION["mensagem"] = "Utilizador não registado!";
      die();
    }

    if (!password_verify($this->mPassword, $this->mResult["password"])) {
      header("location:../index.php");
      $_SESSION["sucesso"] = false;
      $_SESSION["mensagem"] = "Password errada!";
      die();
    } else {
      $stmt = $this->conn->prepare("SELECT * FROM utilizadores WHERE email = :mail");
      $stmt->bindParam(":mail", $this->mEmail);
      $stmt->execute();
      $perfil = $stmt->fetch();

      $_SESSION["user"]["id"] = $perfil["id"];
      $_SESSION["user"]["nome"] = $perfil["nome"];
      $_SESSION["user"]["email"] = $this->mEmail;

      $_SESSION["user"]["foto"] = "http://" . $_SERVER["HTTP_HOST"] . self::PROJFOLDER . $perfil["foto"];
      $_SESSION["user"]["foto_blob"] = $perfil["foto_blob"];
    }

  }

}
$login = new login();
$login->efetuarLogin();
?>
