<?php

class imgBD{


    private $mHost, $mUser, $mPass;
    private $mLastErrorCode, $mLastErrorMsg;
    private $mErrorCodes, $mErrorMsgs;
    private $mBD;

    const SERVERNAME = "localhost";
    const USERNAME = "imgBD";
    const PASSWORD = "123";
    const DEFAULT_PORT = 3306;

    const CREATE_TABLE_USERS =
        "CREATE TABLE IF NOT EXISTS imgbd.tUsers(
        _id INT NOT NULL AUTO_INCREMENT,
        nome TEXT NOT NULL,
        email TEXT NOT NULL,
        password longtext NOT NULL,
        PRIMARY KEY(_id));";

    const CREATE_TABLE_MYIMGS =
        "CREATE TABLE IF NOT EXISTS imgbd.tmyimgs(
        _id INT NOT NULL AUTO_INCREMENT,
        urlImg TEXT NOT NULL,
        dataInserir DATE NOT NULL,
        idUser INT NOT NULL,
        PRIMARY KEY(_id));";

    public function __construct()
    {
        $this->mHost = self::SERVERNAME;
        $this->mUser = self::USERNAME;
        $this->mPass = self::PASSWORD;
        $this->mPort = self::DEFAULT_PORT;

        $this->mBD = mysqli_connect(
            $this->mHost,
            $this->mUser,
            $this->mPass,
            "",
            $this->mPort
        );
        $this->mLastErrorCode = mysqli_connect_errno();
        $this->mLastErrorMsg = mysqli_connect_error();
        $this->mErrorCodes[] = $this->mLastErrorCode;
        $this->mErrorMsgs[] = $this->mLastErrorMsg;

        $this->errorFb();
    }

    private function errorFb(){
        if ($this->mLastErrorCode!==0){
            $strMsg = sprintf(
                "Last error code: %d\n%s",
                $this->mLastErrorCode,
                $this->mLastErrorMsg
            );
            echo $strMsg;
        }
    }//errorFb

    private function updateErrors(){
        $this->mLastErrorCode = mysqli_errno($this->mBD);
        $this->mLastErrorMsg = mysqli_error($this->mBD);
        $this->mErrorCodes[] = $this->mLastErrorCode;
        $this->mErrorMsgs[] = $this->mLastErrorMsg;
    }//updateError

    public function criarBD()
    {
        if ($this->mBD) {
            try {
                $conn = new PDO("mysql:host=$this->mHost", $this->mUser, $this->mPass );
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "CREATE DATABASE IMGBD";
                // use exec() because no results are returned
                $conn->exec($sql);
                echo "Database created successfully<br>";
            } catch (PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }

            $this->mBD->query(self::CREATE_TABLE_USERS);
            $this->updateErrors();
            $this->errorFb();

            $this->mBD->query(self::CREATE_TABLE_MYIMGS);
            $this->updateErrors();
            $this->errorFb();

            $conn = null;

        }
    }

    public function insertUser(
        string $pNome,
        string $pEmail,
        string $pPassword
    ){
        $query = "INSERT INTO imgbd.tUsers  VALUES (".
            "null, '$pNome', '$pEmail','$pPassword');";

        $this->mBD->query($query);

        $this->updateErrors();
        $this->errorFb();
    }//insertUrl

    public function insertUser(
        string $pNome,
        string $pEmail,
        string $pPassword
    ){
        $query = "INSERT INTO imgbd.tUsers  VALUES (".
            "null, '$pNome', '$pEmail','$pPassword');";

        $this->mBD->query($query);

        $this->updateErrors();
        $this->errorFb();
    }//insertUrl

    public function insertImg(
        string $pURL,
        date $pData,
        int $pIdUser
    ){
        $query = "INSERT INTO imgbd.tmyimgs  VALUES (".
            "null, '$pURL', '$pData','$pIdUser');";

        $this->mBD->query($query);

        $this->updateErrors();
        $this->errorFb();
    }//insertUrl
}
$o = new imgBD();
$o ->criarBD();

?>