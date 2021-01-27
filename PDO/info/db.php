<?PHP

class conetarBD{

    private $mHost, $mUser, $mPass, $mNomeBD;
    private $mConn;

    const SERVERNAME = "localhost";
    const USERNAME = "imgBD";
    const PASSWORD = "123";
    const NAMEBD = "imgBD";

    public function __construct()
    {
        $this->mHost = self::SERVERNAME;
        $this->mUser = self::USERNAME;
        $this->mPass = self::PASSWORD;
        $this->mNomeBD = self::NAMEBD;

        try {
            $this->mConn = new PDO("mysql:host=$this->mHost;dbname=$this->mNomeBD", $this->mUser, $this->mPass);
            // set the PDO error mode to exception
            $this->mConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

}
$o= new conetarBD();
?>
