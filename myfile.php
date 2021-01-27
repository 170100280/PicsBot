<?php
    session_start();
    if(!isset($_SESSION["user"]))
    {
      header("location:login.php");
      die();
    }
    include "index.php"
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
            <a class="navbar-brand">PicsBot</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">A Minha Coleção</a>
                    </li>
                    <li class="nav-item">
                        <form method="GET" action="PDO/logoutPDO.php">
                            <input class="nav-link active" type="submit" value="Sair"/>
                        </form>
                    </li>
                </ul>
                <form class="d-flex" method="post" action="">
                    <select class="form-select form-select-sm me-2"  name="categorias" id="categorias" aria-label="Default select example">
                        <?php
                        $myClass = new wallpaperscraftBot();
                        $categ=$myClass->buscarCategorias();
                        foreach ($categ as $key => $value )
                        {
                            foreach ($value as $arrayCateg => $categoria )
                            {
                                echo "<option value=\"$categoria\">$categoria</option>";
                            }
                        }//foreach
                        ?>
                    </select>
                    <input class="btn btn-outline-success" type="submit" value="Submit">
                </form>
            </div>
        </div>
    </nav>
    <div class="container" style="margin-top: 20px; margin-bottom: 20px;">
        <div class="row">
            <!-- LISTA IMAGENS-->
            <div class="col-12">
                <div class="row justify-content-center">
                    <?php
                        $categ1=$myClass->buscarImagensPorCategoria();

                        foreach ($categ1 as $key => $value)
                        {
                    ?>

                    <div class="card col-2" style="width: 18rem;">
                        <img src="<?php echo $value; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <form class="d-flex" method="post" action="imgBD.php">
                                <input type="submit" name ="<?php echo $value; ?>" value="Download" class="btn btn-primary btn-sm"></input>
                            </form>
                        </div>
                    </div>

                        <?php
                    }
                ?></div>
            </div>
        </div>
    </div>
</body>
</html>