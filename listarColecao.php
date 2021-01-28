<?php
session_start();

if (!isset($_SESSION["user"]))
{
    header("location:login.php");
    die();
}//if

include("PDO/info/db.php");

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <title>PicsBot</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="myfile.php">PicsBot</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="myfile.php">Página Incial</a>
                        </li>
                        <li class="nav-item">
                            <form method="GET" action="PDO/logoutPDO.php">
                                <input class="nav-link active btn btn-outline-danger" type="submit" value="Sair" />
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <h2 class="text-center " style="margin-top: 20px; margin-bottom: 20px;" >A MINHA COLEÇÃO DE IMAGENS</h2>
        <div class="container-fluid" style="margin-top: 20px; margin-bottom: 20px;">
            <div class="row">
                <!-- LISTA IMAGENS-->
                <div class="col-12">
                    <div class="row justify-content-center">
                        <?php
                        $id = $_SESSION["user"]["id"];
                        $stmt = $conn->prepare("SELECT urlImg FROM tmyimgs WHERE idUser = :id");
                        $stmt->bindParam(":id", $id);
                        $stmt->execute();
                        $img = $stmt->fetchAll();

                        foreach ($img as $key => $value)
                        {
                        ?>
                            <div class="card col-2" style="width: 18rem;">

                                <img src="<?php echo $value["urlImg"]; ?>" class="card-img-top" alt="">
                                <div class="card-body"></div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>